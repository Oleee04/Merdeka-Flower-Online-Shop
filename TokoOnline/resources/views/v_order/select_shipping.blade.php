<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Cek Ongkir Manual dengan JSON</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<form id="ongkirForm">
    <select name="province" id="province">
        <option value="">Pilih Provinsi</option>
    </select>

    <select name="city" id="city">
        <option value="">Pilih Kota</option>
    </select>

    <input type="number" name="weight" id="weight" placeholder="Berat (gram)" />

    <select name="courier" id="courier">
        <option value="">Pilih Kurir</option>
        <option value="jne">JNE</option>
        <option value="tiki">TIKI</option>
        <option value="pos">POS Indonesia</option>
    </select>

    <button type="submit">Cek Ongkir</button>
</form>

<div id="result"></div>

<script>
  // Data lengkap provinsi dan kota (potongan)
  const data = {
    "31": {
      "name": "DKI Jakarta",
      "cities": [
        {"id": "3171", "name": "Jakarta Selatan"},
        {"id": "3172", "name": "Jakarta Timur"},
        {"id": "3173", "name": "Jakarta Pusat"},
        {"id": "3174", "name": "Jakarta Barat"},
        {"id": "3175", "name": "Jakarta Utara"}
      ]
    },
    "32": {
      "name": "Jawa Barat",
      "cities": [
        {"id": "3201", "name": "Bandung"},
        {"id": "3202", "name": "Bekasi"},
        {"id": "3203", "name": "Bogor"},
        {"id": "3204", "name": "Cimahi"},
        {"id": "3205", "name": "Cirebon"}
      ]
    },
    "33": {
      "name": "Jawa Tengah",
      "cities": [
        {"id": "3301", "name": "Semarang"},
        {"id": "3302", "name": "Solo"},
        {"id": "3303", "name": "Magelang"},
        {"id": "3304", "name": "Pekalongan"}
      ]
    }
  };

  const provinceSelect = document.getElementById('province');
  const citySelect = document.getElementById('city');

  // Isi dropdown provinsi
  for (const [provId, prov] of Object.entries(data)) {
    const opt = document.createElement('option');
    opt.value = provId;
    opt.textContent = prov.name;
    provinceSelect.appendChild(opt);
  }

  provinceSelect.addEventListener('change', () => {
    const provId = provinceSelect.value;
    citySelect.innerHTML = '<option value="">Pilih Kota</option>';
    if(data[provId]){
      data[provId].cities.forEach(city => {
        const opt = document.createElement('option');
        opt.value = city.id;
        opt.textContent = city.name;
        citySelect.appendChild(opt);
      });
    }
  });

  // Submit form cek ongkir
  document.getElementById('ongkirForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const origin = 501; // contoh kode kota asal (bebas sesuaikan)
    const destination = citySelect.value;
    const weight = document.getElementById('weight').value;
    const courier = document.getElementById('courier').value;
    const resultDiv = document.getElementById('result');

    if(!destination || !weight || !courier){
      alert('Mohon lengkapi semua data!');
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
      if(data.rajaongkir.status.code === 200){
        resultDiv.innerHTML = '';
        const costs = data.rajaongkir.results[0].costs;
        costs.forEach(cost => {
          const div = document.createElement('div');
          div.textContent = `${cost.service} : ${cost.cost[0].value} Rupiah (${cost.cost[0].etd} hari)`;
          resultDiv.appendChild(div);
        });
      } else {
        resultDiv.textContent = 'Gagal mengambil data ongkir: ' + data.rajaongkir.status.description;
      }
    })
    .catch(err => {
      resultDiv.textContent = 'Error: ' + err.message;
    });
  });
</script>
</body>
</html>
