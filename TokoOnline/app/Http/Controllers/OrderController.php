<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer.user')->get();
        return view('backend.v_pesanan.index', compact('orders'));
    }

    public function statusProses()
    {
        $orders = Order::with(['customer.user'])
            ->whereIn('status', ['Paid', 'Kirim'])
            ->orderByDesc('id')
            ->get();

        return view('backend.v_pesanan.proses', [
            'judul' => 'Pesanan',
            'subJudul' => 'Pesanan Proses',
            'index' => $orders
        ]);
    }

    public function statusSelesai()
    {
        $orders = Order::with(['customer.user'])
            ->where('status', 'Selesai')
            ->orderByDesc('id')
            ->get();

        return view('backend.v_pesanan.selesai', [
            'judul' => 'Data Transaksi',
            'subJudul' => 'Pesanan Selesai',
            'index' => $orders
        ]);
    }

    public function statusDetail($id)
    {
        $order = Order::with([
            'orderItems.produk.kategori',
            'customer.user'
        ])->findOrFail($id);

        return view('v_order.detail', [
            'judul' => 'Data Transaksi',
            'subJudul' => 'Detail Pesanan',
            'order' => $order
        ]);
    }

    public function statusDetailAdmin($id)
{
    $order = Order::with([
        'orderItems.produk.kategori',
        'customer.user'
    ])->findOrFail($id);

    return view('backend.v_pesanan.detail', [
        'judul' => 'Manajemen Pesanan',
        'subJudul' => 'Detail Transaksi',
        'order' => $order
    ]);
}

    public function statusUpdate(Request $request, $id)
{
    $request->validate([
        'noresi' => 'nullable|string',
        'status' => 'required|string',
        'alamat' => 'required|string',
        'pos' => 'required|string',
        'hp' => 'nullable|string|max:15', // Tambahkan validasi HP
    ]);

    $order = Order::findOrFail($id);
    $order->update([
        'noresi' => $request->noresi,
        'status' => $request->status,
        'alamat' => $request->alamat,
        'pos' => $request->pos,
        'hp' => $request->hp, // Tambahkan field HP
    ]);

    return redirect()->back()->with('success', 'Pesanan berhasil diupdate');
}

    public function addToCart($id)
    {
        $customer = Customer::where('user_id', Auth::id())->firstOrFail();
        $produk = Produk::findOrFail($id);

        $order = Order::firstOrCreate(
            ['customer_id' => $customer->id, 'status' => 'pending'],
            ['total_harga' => 0]
        );

        $item = OrderItem::firstOrCreate(
            ['order_id' => $order->id, 'produk_id' => $produk->id],
            ['quantity' => 1, 'harga' => $produk->harga]
        );

        if (!$item->wasRecentlyCreated) {
            $item->increment('quantity');
        }

        $order->increment('total_harga', $produk->harga);

        return redirect()->route('order.cart')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function viewCart()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $order = $customer ? Order::with('orderItems.produk')
            ->where('customer_id', $customer->id)
            ->where('status', 'pending')
            ->first() : null;

        return view('v_order.cart', compact('order'));
    }

    public function updateCart(Request $request, $id)
    {
        $customer = Customer::where('user_id', Auth::id())->firstOrFail();
        $order = Order::where('customer_id', $customer->id)->where('status', 'pending')->first();

        if ($order) {
            $item = $order->orderItems()->where('id', $id)->first();
            if ($item) {
                $qty = $request->input('quantity');
                if ($qty > $item->produk->stok) {
                    return redirect()->route('order.cart')->with('error', 'Jumlah produk melebihi stok yang tersedia');
                }

                $order->total_harga -= $item->harga * $item->quantity;
                $item->update(['quantity' => $qty]);
                $order->total_harga += $item->harga * $qty;
                $order->save();
            }
        }

        return redirect()->route('order.cart')->with('success', 'Jumlah produk berhasil diperbarui');
    }

    public function removeFromCart($id)
    {
        $customer = Customer::where('user_id', Auth::id())->firstOrFail();
        $order = Order::where('customer_id', $customer->id)->where('status', 'pending')->first();

        if ($order) {
            $item = OrderItem::where('order_id', $order->id)->where('produk_id', $id)->first();
            if ($item) {
                $order->total_harga -= $item->harga * $item->quantity;
                $item->delete();

                if ($order->total_harga <= 0) {
                    $order->delete();
                } else {
                    $order->save();
                }
            }
        }

        return redirect()->route('order.cart')->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function checkout() 
    {
        $customer = Customer::where('user_id', Auth::id())->first();

        if (!$customer) {
            return redirect()->route('order.cart')->with('error', 'Data customer tidak ditemukan.');
        }

        $order = Order::where('customer_id', $customer->id)
                      ->where('status', 'pending')
                      ->first();

        if (!$order) {
            return redirect()->route('order.cart')->with('error', 'Tidak ada pesanan yang pending.');
        }

        // Cek stok dan simpan status tetap 'pending'
        foreach ($order->orderItems as $item) {
            $produk = $item->produk;

            if ($produk->stok < $item->quantity) {
                return redirect()->route('order.cart')->with('error', 'Stok produk ' . $produk->nama_produk . ' tidak mencukupi.');
            }
        }

        // Tambahkan alamat/biaya ongkir jika perlu di sini sebelum redirect

        return redirect()->route('order.selectpayment', ['order_id' => $order->id])
                         ->with('success', 'Checkout berhasil. Silakan pilih metode pembayaran.');
    }

    public function history()
    {
        $customer = Customer::where('user_id', Auth::id())->first();

        if (!$customer) {
            return view('v_order.history', ['orders' => collect()]);
        }

        $statuses = ['paid', 'kirim', 'selesai'];

        $orders = Order::with(['customer.user', 'orderItems.produk'])
            ->where('customer_id', $customer->id)
            ->whereIn('status', $statuses)
            ->orderBy('id', 'desc')
            ->get();

        return view('v_order.history', compact('orders'));
    }

    public function selectPayment($order_id)
{
    $user = Auth::user();
    $customer = Customer::where('user_id', $user->id)->firstOrFail();
    $order = Order::with('orderItems.produk')->where('id', $order_id)->firstOrFail();

    if ($order->status !== 'pending') {
        return redirect()->route('order.history')->with('error', 'Pesanan tidak valid atau sudah diproses.');
    }

    // KURANGI STOK LANGSUNG SAAT CHECKOUT
    foreach ($order->orderItems as $item) {
        $produk = $item->produk;
        
        if ($produk->stok < $item->quantity) {
            return redirect()->route('order.cart')->with('error', 'Stok produk tidak mencukupi.');
        }
        
        // KURANGI STOK
        $produk->decrement('stok', $item->quantity);
        Log::info("Stok produk {$produk->nama_produk} dikurangi {$item->quantity}");
    }

    // Ubah status jadi Paid (atau waiting_payment jika ingin menunggu konfirmasi pembayaran)
    $order->status = 'Paid';
    $order->save();

    // Midtrans setup
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $grossAmount = $order->total_harga + $order->biaya_ongkir;

    $params = [
        'transaction_details' => [
            'order_id' => $order->id . '-' . time(),
            'gross_amount' => (int) $grossAmount,
        ],
        'customer_details' => [
            'first_name' => $user->nama,
            'email' => $user->email,
            'phone' => $user->hp,
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('v_order.selectpayment', [
        'order' => $order,
        'snapToken' => $snapToken,
    ]);
}

    public function callback(Request $request)
{
    Log::info('Midtrans Callback Diterima:', $request->all());

    $serverKey = config('midtrans.server_key');
    $signatureKey = hash("sha512", 
        $request->order_id .
        $request->status_code .
        $request->gross_amount .
        $serverKey
    );

    if ($signatureKey !== $request->signature_key) {
        Log::warning('Midtrans signature tidak valid.');
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    $realOrderId = explode('-', $request->order_id)[0];
    $order = Order::find($realOrderId);

    if (!$order) {
        Log::error('Order tidak ditemukan: ' . $realOrderId);
        return response()->json(['message' => 'Order not found'], 404);
    }

    // Proses status pembayaran
    switch ($request->transaction_status) {
        case 'capture':
        case 'settlement':
            // KURANGI STOK HANYA SAAT PEMBAYARAN BERHASIL
            if ($order->status !== 'Paid') { // Cegah double pengurangan
                foreach ($order->orderItems as $item) {
                    $produk = $item->produk;
                    
                    // Validasi stok sekali lagi
                    if ($produk->stok >= $item->quantity) {
                        $produk->decrement('stok', $item->quantity);
                        Log::info("Stok produk {$produk->nama_produk} dikurangi {$item->quantity}");
                    } else {
                        Log::warning("Stok produk {$produk->nama_produk} tidak mencukupi saat callback");
                    }
                }
            }
            $order->status = 'Paid';
            break;

        case 'pending':
            $order->status = 'waiting_payment';
            break;

        case 'deny':
        case 'cancel':
        case 'expire':
            $order->status = 'cancelled';
            break;

        default:
            $order->status = 'waiting_payment';
            break;
    }

    $order->save();
    Log::info("Status order ID {$order->id} diperbarui ke: {$order->status}");

    return response()->json(['message' => 'Callback processed']);
}

    public function complete()
    {
        return redirect()->route('order.history')->with('success', 'Checkout berhasil');
    }

    public function formOrderProses()
    {
        return view('backend.v_pesanan.formproses', [
            'judul' => 'Laporan',
            'subJudul' => 'Laporan Pesanan Proses',
        ]);
    }

    public function cetakOrderProses(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $orders = Order::with(['customer.user'])
            ->whereIn('status', ['Paid', 'Kirim'])
            ->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('backend.v_pesanan.cetakproses', compact('orders'));
    }
    public function invoiceBackend($id)
    {
        $order = Order::with(['orderItems.produk', 'customer.user'])->findOrFail($id);
        return view('backend.v_pesanan.invoice', compact('order'));
    }

     public function showForm()
    {
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        // Simpan ke log (atau kirim email/simpan DB jika diperlukan)
        Log::info('Pesan Kontak Masuk:', $validated);

        // Redirect kembali dengan flash message
        return redirect()->route('contact.form')->with('success', 'Pesan berhasil dikirim!');
    }
    // Add this method after invoiceBackend()
public function invoiceFrontend($id)
{
    $order = Order::with(['orderItems.produk', 'customer.user'])->findOrFail($id);
    return view('v_order.invoice', compact('order'));
}
}