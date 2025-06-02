@extends('v_layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="order-summary clearfix">
                    <div class="section-title">
                        <p>HISTORY</p>
                        <h3 class="title">Order History</h3>
                    </div>

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Total Payment</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td>Rp. {{ number_format($order->total_harga + $order->biaya_ongkir, 0, ',', '.') }}</td>
                                    <td>
                                        @switch($order->status)
                                            @case('Paid')
                                                <span class="badge badge-success">Paid</span>
                                                @break
                                            @case('Kirim')
                                                <span class="badge badge-warning">Shipped</span>
                                                @break
                                            @case('Selesai')
                                                <span class="badge badge-primary">Completed</span>
                                                @break
                                            @default
                                                <span class="badge badge-secondary">{{ $order->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if (Route::has('order.detail'))
                                            <a href="{{ route('order.detail', $order->id) }}" class="btn btn-danger btn-sm">View Details</a>
                                        @endif
                                        @if (Route::has('order.invoice'))
                                            <a href="{{ route('order.invoice', $order->id) }}" class="btn btn-info btn-sm">Invoice</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No paid orders yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
