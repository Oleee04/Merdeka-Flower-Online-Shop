@extends('v_layouts.app') 

@section('content') 
<div class="col-md-12"> 
    <div class="order-summary clearfix"> 
        <div class="section-title"> 
            <p>PAYMENT</p> 
            <h3 class="title">Payment Confirmation</h3> 
        </div> 

        @if(session()->has('success')) 
            <div class="alert alert-success alert-dismissible" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                <strong>{{ session('success') }}</strong> 
            </div> 
        @endif 
        @if(session()->has('error')) 
            <div class="alert alert-danger alert-dismissible" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                <strong>{{ session('error') }}</strong> 
            </div> 
        @endif 

        @if($order && $order->orderItems->count() > 0) 
            <table class="shopping-cart-table table"> 
                <thead> 
                    <tr> 
                        <th>Product</th> 
                        <th></th> 
                        <th class="text-center">Price</th> 
                        <th class="text-center">Quantity</th> 
                        <th class="text-center">Total</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @php 
                        $totalHarga = 0; 
                        $totalBerat = 0; 
                    @endphp 
                    @foreach($order->orderItems as $item) 
                        @php 
                            $totalHarga += $item->harga * $item->quantity; 
                            $totalBerat += $item->produk->berat * $item->quantity; 
                        @endphp 
                        <tr> 
                            <td class="thumb"><img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}" alt=""></td> 
                            <td class="details"> 
                                <a>{{ $item->produk->nama_produk }}</a> 
                                <ul> 
                                    <li><span>Weight: {{ $item->produk->berat }} Grams</span></li> 
                                </ul> 
                                <ul> 
                                    <li><span>Stock: {{ $item->produk->stok }} Grams</span></li> 
                                </ul> 
                            </td> 
                       <td class="price text-center"><strong>Rp {{ number_format($item->harga, 0, ',', '.') }}</strong></td> 
                            <td class="qty text-center">{{ $item->quantity }}</td> 
                            <td class="total text-center"><strong class="primary-color">Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</strong></td> 
                        </tr> 
                    @endforeach 
                </tbody> 
                <tfoot> 
                    <tr> 
                        <th class="empty" colspan="3"></th> 
                        <th>SUBTOTAL</th> 
                        <th colspan="2" class="sub-total">Rp {{ number_format($totalHarga, 0, ',', '.') }}</th> 
                    </tr>
                    <tr> 
                        <th class="empty" colspan="3"></th> 
                        <th>TOTAL PAYMENT</th> 
                        <th colspan="2" class="total">Rp {{ number_format($totalHarga + $order->biaya_ongkir, 0, ',', '.') }}</th> 
                    </tr> 
                </tfoot> 
            </table> 

            <input type="hidden" name="total_price" value="{{ $totalHarga }}"> 
            <input type="hidden" name="total_weight" value="{{ $totalBerat }}"> 

            <div class="pull-right"> 
                <button class="primary-btn" id="pay-button">Pay Now</button> 
            </div> 
        @else 
            <p>Your shopping cart is empty.</p> 
        @endif 
    </div> 
</div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log('Success:', result);
                window.location.href = "{{ route('order.complete') }}";
            },
            onPending: function(result) {
                console.log('Pending:', result);
                window.location.href = "{{ route('order.history') }}";
            },
            onError: function(result) {
                console.log('Error:', result);
                alert("Payment failed. Please try again.");
            },
            onClose: function() {
                alert('Transaction canceled.');
            }
        });
    });
</script>
@endsection
