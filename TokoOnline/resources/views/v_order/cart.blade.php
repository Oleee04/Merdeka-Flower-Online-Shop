@extends('v_layouts.app')

@section('content')
<div class="col-md-12">
    <div class="order-summary clearfix">
        <div class="section-title">
            <p>CART</p>
            <h3 class="title">Shopping Cart</h3>
        </div>

        <!-- msgSuccess -->
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ session('success') }}</strong>
        </div>
        @endif

        <!-- msgError -->
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
                    <th class="text-right"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalHarga = 0;
                @endphp
                @foreach($order->orderItems as $item)
                @php
                    $totalHarga += $item->harga * $item->quantity;
                @endphp
                <tr>
                    <td class="thumb">
                        <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}" alt="" style="width: 80px;">
                    </td>
                    <td class="details">
                        <a>{{ $item->produk->nama_produk }}</a>
                        <ul>
                            <li><span>Weight: {{ $item->produk->berat }} Grams</span></li>
                            <li><span>Stock: {{ $item->produk->stok }} Grams</span></li>
                        </ul>
                    </td>
                    <td class="price text-center"><strong>Rp. {{ number_format($item->harga, 0, ',', '.') }}</strong></td>
                    <td class="qty text-center">
                        <form action="{{ route('order.updateCart', $item->id) }}" method="post">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 60px;">
                            <button type="submit" class="btn btn-sm btn-warning">Update</button>
                        </form>
                    </td>
                    <td class="total text-center">
                        <strong class="primary-color">Rp. {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</strong>
                    </td>
                    <td class="text-right">
                        <form action="{{ route('order.remove', $item->produk->id) }}" method="post">
                            @csrf
                            <button class="main-btn icon-btn"><i class="fa fa-close"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Subtotal and Total Payment -->
        <div class="col-md-4 col-md-offset-8">
            <div class="billing-details">
                <table class="table table-bordered">
                    <tr>
                        <th>SUBTOTAL</th>
                        <td><strong>Rp. {{ number_format($totalHarga, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <th>TOTAL PAYMENT</th>
                        <td><strong style="color: red;">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>

                <form action="{{ route('order.checkout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block" id="pay-button">CONFIRM PAYMENT</button>
                </form>
            </div>  
        </div>
        @else
        <p>Your shopping cart is empty.</p>
        @endif
    </div>
</div>
@endsection
