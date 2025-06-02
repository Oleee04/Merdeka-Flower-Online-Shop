@extends('layouts.app') {{-- Opsional: Sesuaikan dengan layout milikmu --}}
@section('title', 'Cek Ongkir')

@section('content')
    <div class="container">
        <h2>Cek Ongkos Kirim</h2>
        <form id="ongkirForm">
            @csrf {{-- Jika diperlukan di server-side --}}
            
            <label for="province">Provinsi:</label>
            <select name="province" id="province" required>
                <option value="">Pilih Provinsi</option>
            </select>

            <label for="city">Kota:</label>
            <select name="city" id="city" required>
                <option value="">Pilih Kota</option>
            </select>

            <label for="weight">Berat (gram):</label>
            <input type="number" name="weight" id="weight" placeholder="Berat dalam gram" required>

            <label for="courier">Kurir:</label>
            <select name="courier" id="courier" required>
                <option value="">Pilih Kurir</option>
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">POS Indonesia</option>
            </select>

            <button type="submit">Cek Ongkir</button>
        </form>

        <div id="result" style="margin-top: 20px;"></div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Load provinsi
            fetch('/provinces')
                .then(res => res.json())
                .then(data => {
                    if (data.rajaongkir.status.code === 200) {
                        const provinces = data.rajaongkir.results;
                        const provinceSelect = document.getElementById('province');
                        provinces.forEach(prov => {
                            const option = document.createElement('option');
                            option.value = prov.province_id;
                            option.textContent = prov.province;
                            provinceSelect.appendChild(option);
                        });
                    } else {
                        alert('Gagal mengambil data provinsi: ' + data.rajaongkir.status.description);
                    }
                })
                .catch(err => console.error('Error ambil provinsi:', err));

            // Load kota berdasarkan provinsi
            document.getElementById('province').addEventListener('change', function () {
                const provinceId = this.value;
                const citySelect = document.getElementById('city');
                citySelect.innerHTML = '<option value="">Pilih Kota</option>';

                if (!provinceId) return;

                fetch(`/cities?province_id=${provinceId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.rajaongkir.status.code === 200) {
                            const cities = data.rajaongkir.results;
                            cities.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.city_id;
                                option.textContent = city.city_name;
                                citySelect.appendChild(option);
                            });
                        } else {
                            alert('Gagal mengambil data kota: ' + data.rajaongkir.status.description);
                        }
                    })
                    .catch(err => console.error('Error ambil kota:', err));
            });

            // Cek ongkir
            document.getElementById('ongkirForm').addEventListener('submit', function (event) {
                event.preventDefault();

                const origin = 501; // ganti sesuai kota asalmu (ID kota)
                const destination = document.getElementById('city').value;
                const weight = document.getElementById('weight').value;
                const courier = document.getElementById('courier').value;

                if (!destination || !weight || !courier) {
                    alert('Harap lengkapi semua kolom!');
                    return;
                }

                fetch('/cost', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        origin: origin,
                        destination: destination,
                        weight: weight,
                        courier: courier
                    })
                })
                .then(res => res.json())
                .then(data => {
                    const resultDiv = document.getElementById('result');
                    resultDiv.innerHTML = '';

                    if (data.rajaongkir.status.code === 200) {
                        const costs = data.rajaongkir.results[0].costs;
                        if (costs.length === 0) {
                            resultDiv.textContent = 'Tidak ada layanan tersedia.';
                        } else {
                            costs.forEach(service => {
                                const div = document.createElement('div');
                                div.textContent = `${service.service}: Rp ${service.cost[0].value.toLocaleString()} (${service.cost[0].etd} hari)`;
                                resultDiv.appendChild(div);
                            });
                        }
                    } else {
                        resultDiv.textContent = 'Gagal mendapatkan ongkos kirim: ' + data.rajaongkir.status.description;
                    }
                })
                .catch(err => console.error('Error ambil ongkir:', err));
            });
        });
    </script>
@endsection
