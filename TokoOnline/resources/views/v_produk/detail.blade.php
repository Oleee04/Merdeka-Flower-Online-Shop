@extends('v_layouts.app')

@section('content')
<!-- template -->

<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="billing-details">
            <div class="section-title">
                <h3 class="title">{{ $judul }}</h3>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="product product-details clearfix">
        <div class="col-md-6">
            <div id="product-main-view">
                <div class="product-view">
                    <img src="{{ asset('storage/img-produk/thumb_lg_' . $row->foto) }}" alt="">
                </div>
                @foreach ($fotoProdukTambahan as $item)
                    @if ($item->produk_id == $row->id)
                        <div class="product-view">
                            <img src="{{ asset('storage/img-produk/' . $item->foto) }}" alt="">
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="product-view">
                <div class="product-view">
                    <img src="{{ asset('storage/img-produk/thumb_sm_' . $row->foto) }}" alt="">
                </div>
                @foreach ($fotoProdukTambahan as $item)
                    @if ($item->produk_id == $row->id)
                        <div class="product-view">
                            <img src="{{ asset('storage/img-produk/' . $item->foto) }}" alt="">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <div class="product-body">
                <div class="product-label">
                    <span>Category</span>
                    <span class="sale">{{ $row->kategori->nama_kategori }}</span>
                </div>

                <h2 class="product-name">{{ $row->nama_produk }}</h2>

                <h3 class="product-price">Rp. {{ number_format($row->harga, 0, ',', '.') }}</h3>

                <p>{!! $row->detail !!}</p>

                <div class="product-options">
                    <ul class="size-option">
                        <li><span class="text-uppercase">Heavy:</span> {{ $row->berat }} Gram</li>
                    </ul>
                    <ul class="size-option">
                        <li><span class="text-uppercase">Stock:</span> {{ $row->stok }}</li>
                    </ul>
                </div>

                <div class="product-btns">
                      <form action="{{ route('order.addToCart', $row->id) }}" method="post" 
                        style="display: inline-block;" title="Pesan Ke Aplikasi"> 
                        @csrf 
                        <button type="submit" class="primary-btn add-to-cart"><i 
                                class="fa fa-shopping-cart"></i> Add</button> 
                        </form> 
                </div>
            </div>
        </div>
    </div>
    <!-- /Product Details -->
</div>

<!-- end template-->
@endsection
