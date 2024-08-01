<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\WarnaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengirimController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembelianItemController;
use App\Http\Controllers\PenjualanItemController;

// Public route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Routes for both user and admin
    Route::resource('penjualan_item', PenjualanItemController::class);


    // Route::get('pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    // Route::post('pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');


    // Route::post('/lock-item', [PenjualanController::class, 'lockItem'])->name('lock-item');
    // Route::post('/unlock-item', [PenjualanController::class, 'unlockItem'])->name('unlock-item');
    // Route::post('/unlock-all-items', [PenjualanController::class, 'unlockAllItems'])->name('unlock-all-items');

    // Routes for user
    Route::middleware(['isUser'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
        Route::post('dashboard/store', [DashboardController::class, 'storePurchase'])->name('storePurchase');
        Route::get('/purchase-history', [DashboardController::class, 'purchaseHistory'])->name('purchase.history');

        Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
        Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
        // Route::get('pelanggan/show', [PelangganController::class, 'show'])->name('pelanggan.show');
        // Route::get('pelanggan/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
        Route::get('pelanggan/create-from-penjualan', [PelangganController::class, 'createFromPenjualan'])->name('pelanggan.createFromPenjualan');
        Route::post('pelanggan/store-from-penjualan', [PelangganController::class, 'storeFromPenjualan'])->name('pelanggan.storeFromPenjualan');

        Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
        Route::post('/penjualan/store', [PenjualanController::class, 'storeWithItems'])->name('penjualan.storeWithItems');
        Route::get('/riwayat-penjualan', [PenjualanController::class, 'riwayatPenjualan'])->name('penjualan.riwayat');
        Route::resource('pembelian_items', PembelianItemController::class);
        Route::post('/penjualan/{penjualan}/status/{status}', [PenjualanController::class, 'updateStatus'])->name('penjualan.updateStatus');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pelanggan', PelangganController::class)->except(['store']);

    // Routes for admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
        Route::resource('pembelian', PembelianController::class);
        Route::post('pembelian/storeWithItems', [PembelianController::class, 'storeWithItems'])->name('pembelian.storeWithItems');
        Route::post('/pembelian/{pembelian}/status/{status}', [PembelianController::class, 'updateStatus'])->name('pembelian.updateStatus');
        Route::resource('penjualan', PenjualanController::class)->except(['create', 'store']);
        Route::post('/penjualan/{penjualan}/status/{status}', [PenjualanController::class, 'updateStatus'])->name('penjualan.updateStatus');
        Route::resource('pembelian_item', PembelianItemController::class);

        Route::get('vendor/create-from-pembelian', [VendorController::class, 'createFromPembelian'])->name('vendor.createFromPembelian');
Route::post('vendor/store-from-pembelian', [VendorController::class, 'storeFromPembelian'])->name('vendor.storeFromPembelian');

        Route::resource('pengirim', PengirimController::class);
        Route::resource('status', StatusController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('stok', StokController::class);
        Route::resource('warna', WarnaController::class);
    });
    Route::resource('vendor', VendorController::class)->except(['store']);
});

// Route for viewing barang details (auth middleware added)
Route::get('/barang/{id}/detail', [StokController::class, 'showDetail'])->name('barang.detail')->middleware('auth');

// Vendor routes


// API routes for warna and stok
Route::get('api/warna/{barang_id}', [BarangController::class, 'getWarna']);
Route::get('api/stok/{barang_id}/{warna_id}', [StokController::class, 'getStokByBarangAndWarna']);

require __DIR__ . '/auth.php';
