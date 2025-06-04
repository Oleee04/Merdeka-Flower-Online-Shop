<?php 
 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http; 
use App\Http\Controllers\BerandaController; 
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RajaOngkirController;
 
 
Route::get('/', function () { 
    // return view('welcome'); 
    return redirect()->route('beranda');
});

Route::get('/cek-ongkir', function () { 
    return view('ongkir'); 
}); 
 
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']); 
Route::get('/cities', [RajaOngkirController::class, 'getCities']); 
Route::post('/cost', [RajaOngkirController::class, 'getCost']);
 

Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth'); 
 
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login'); 
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login'); 
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout'); 

// Route untuk User 
Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth'); 
// Route untuk laporan user 
    // Laporan User
    Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser');
    Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser');

    // Laporan Penjualan
     Route::get('backend/laporan/formpenjualan', [UserController::class, 'formPenjualan'])->name('backend.laporan.formpenjualan');
    Route::post('backend/laporan/formpenjualan', [UserController::class, 'cetakPenjualan'])->name('backend.laporan.cetakpenjualan');
 
// Route untuk Kategori 
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend'])->middleware('auth'); 
Route::get('/pesanan/create', [UserController::class, 'create'])->name('backend.pesanan.create');
Route::post('/pesanan/store', [UserController::class, 'store'])->name('backend.pesanan.store');

// Route untuk Pesanan Backend
Route::get('backend/pesanan', [OrderController::class, 'index'])->name('backend.pesanan.index')->middleware('auth');
Route::get('/pesanan/proses', [OrderController::class, 'statusProses'])->name('pesanan.proses')->middleware('auth');
Route::get('/pesanan/selesai', [OrderController::class, 'statusSelesai'])->name('pesanan.selesai')->middleware('auth');
Route::get('/backend/pesanan/{id}/detail', [OrderController::class, 'statusDetailAdmin'])
    ->name('backend.v_pesanan.detail');

Route::put('/pesanan/update/{id}', [OrderController::class, 'statusUpdate'])->name('pesanan.update')->middleware('auth');
Route::get('/pesanan/invoice/{id}', [OrderController::class, 'invoiceBackend'])->name('pesanan.invoice')->middleware('auth');

// Route untuk Laporan Pesanan
Route::get('backend/laporan/formproses', [OrderController::class, 'formOrderProses'])->name('backend.laporan.formproses')->middleware('auth');
Route::post('backend/laporan/cetakproses', [OrderController::class, 'cetakOrderProses'])->name('backend.laporan.cetakproses')->middleware('auth');
Route::get('backend/laporan/formselesai', [OrderController::class, 'formOrderSelesai'])->name('backend.laporan.formselesai')->middleware('auth');
Route::post('backend/laporan/cetakselesai', [OrderController::class, 'cetakOrderSelesai'])->name('backend.laporan.cetakselesai')->middleware('auth');

// Route untuk Produk 
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth'); 
// Route untuk menambahkan foto 
Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store')->middleware('auth'); 
// Route untuk menghapus foto
Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy')->middleware('auth');
// Route untuk laporan produk 
Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk')->middleware('auth'); 
Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk')->middleware('auth');

// Route untuk Customer 
Route::resource('backend/customer', CustomerController::class, ['as' => 'backend'])->middleware('auth');

// Frontend 
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/lokasi', function () {
    return view('lokasi');
})->name('lokasi');
Route::get('/cara-pesan', function () {
    return view('cara-pesan');
})->name('cara.pesan');
Route::get('/hubungi-kami', function () {
    return view('contact');
})->name('contact');

//Produk
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/produk/kategori/{id}', [ProdukController::class, 'produkKategori'])->name('produk.kategori');
Route::get('/produk/all', [ProdukController::class, 'produkAll'])->name('produk.all');

//API Google 
Route::get('/auth/redirect', [CustomerController::class, 'redirect'])->name('auth.redirect'); 
Route::get('/auth/google/callback', [CustomerController::class, 'callback'])->name('auth.callback'); 
// Logout 
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');

// Midtrans Callback (harus di luar middleware untuk menerima notifikasi dari Midtrans)
Route::post('/midtrans/callback', [OrderController::class, 'callback'])->name('midtrans.callback');

// Group route untuk customer 
Route::middleware('is.customer')->group(function () { 
    // Route untuk menampilkan halaman akun customer 
    Route::get('/customer/akun/{id}', [CustomerController::class, 'akun']) 
        ->name('customer.akun'); 
 
    // Route untuk mengupdate data akun customer 
    Route::put('/customer/updateakun/{id}', [CustomerController::class, 'updateAkun']) 
        ->name('customer.akun.update'); 
 
    // Route keranjang belanja 
    Route::post('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('order.addToCart'); 
    Route::get('cart', [OrderController::class, 'viewCart'])->name('order.cart'); 
    Route::post('cart/update/{id}', [OrderController::class, 'updateCart'])->name('order.updateCart'); 
    Route::post('remove/{id}', [OrderController::class, 'removeFromCart'])->name('order.remove');
    
    // Route untuk proses checkout dan shipping
    Route::post('checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/order/selectshipping', [OrderController::class, 'selectShipping'])->name('order.selectshipping');
    Route::post('/order/updateongkir', [OrderController::class, 'updateOngkir'])->name('order.updateongkir');
    
    // Route untuk payment
    Route::get('/order/selectpayment/{order_id}', [OrderController::class, 'selectPayment'])->name('order.selectpayment');
    Route::get('/order/pending', [OrderController::class, 'pending'])->name('order.pending');
    Route::get('/order/complete', [OrderController::class, 'complete'])->name('order.complete');

    // Route untuk history
    Route::get('/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('order.orderhistory'); // Alias
    Route::get('/history/{id}', [OrderController::class, 'statusDetail'])->name('order.detail');
    Route::get('/history/{id}/invoice', [OrderController::class, 'invoiceFrontend'])->name('order.invoice');
});