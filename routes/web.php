<?php

use App\Models\PenjualanItem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengirimController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembelianItemController;
use App\Http\Controllers\PenjualanItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('barang', BarangController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('pembelian', PembelianController::class);
Route::resource('pembelian_item', PembelianItemController::class);
Route::resource('pengirim', PengirimController::class);
Route::resource('penjualan', PenjualanController::class);
Route::resource('penjualan_item', PenjualanItemController::class);
Route::resource('status', StatusController::class);
Route::resource('vendor', VendorController::class);

Route::model('penjualan_item', PenjualanItem::class);

Route::post('/pembelian/storeWithItems', [PembelianController::class, 'storeWithItems'])->name('pembelian.storeWithItems');

// Pembelian Routes
Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::post('/pembelian', [PembelianController::class, 'storeWithItems'])->name('pembelian.store');
Route::get('/pembelian/{pembelian}', [PembelianController::class, 'show'])->name('pembelian.show');
Route::get('/pembelian/{pembelian}/edit', [PembelianController::class, 'edit'])->name('pembelian.edit');
Route::put('/pembelian/{pembelian}', [PembelianController::class, 'update'])->name('pembelian.update');
Route::delete('/pembelian/{pembelian}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');

// Pembelian Item Routes
Route::get('/pembelian_item', [PembelianItemController::class, 'index'])->name('pembelian_item.index');
Route::get('/pembelian_item/create', [PembelianItemController::class, 'create'])->name('pembelian_item.create');
Route::post('/pembelian_item', [PembelianItemController::class, 'store'])->name('pembelian_item.store');
Route::get('/pembelian_item/{pembelian_item}', [PembelianItemController::class, 'show'])->name('pembelian_item.show');
Route::get('/pembelian_item/{pembelian_item}/edit', [PembelianItemController::class, 'edit'])->name('pembelian_item.edit');
Route::put('/pembelian_item/{pembelian_item}', [PembelianItemController::class, 'update'])->name('pembelian_item.update');
Route::delete('/pembelian_item/{pembelian_item}', [PembelianItemController::class, 'destroy'])->name('pembelian_item.destroy');

Route::post('barang/update-stock/{pembelian}', [BarangController::class, 'updateStockFromPembelian'])->name('barang.updateStockFromPembelian');
Route::get('pembelian/{pembelian}/updateStatus/{status}', [PembelianController::class, 'updateStatus'])->name('pembelian.updateStatus');

Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan', [PenjualanController::class, 'storeWithItems'])->name('penjualan.store');
Route::get('/penjualan/{penjualan}', [PenjualanController::class, 'show'])->name('penjualan.show');
Route::get('/penjualan/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::put('/penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('penjualan.update');
Route::delete('/penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
Route::get('/penjualan/{penjualan}/updateStatus/{status}', [PenjualanController::class, 'updateStatus'])->name('penjualan.updateStatus');

Route::post('penjualan/storeWithItems', [PenjualanController::class, 'storeWithItems'])->name('penjualan.storeWithItems');
Route::get('penjualan/{penjualan}/status/{status}', [PenjualanController::class, 'updateStatus'])->name('penjualan.updateStatus');

Route::get('/penjualan_item', [PenjualanItemController::class, 'index'])->name('penjualan_item.index');
Route::get('/penjualan_item/create', [PenjualanItemController::class, 'create'])->name('penjualan_item.create');
Route::post('/penjualan_item', [PenjualanItemController::class, 'store'])->name('penjualan_item.store');
Route::get('/penjualan_item/{penjualan_item}', [PenjualanItemController::class, 'show'])->name('penjualan_item.show');
Route::get('/penjualan_item/{penjualan_item}/edit', [PenjualanItemController::class, 'edit'])->name('penjualan_item.edit');
Route::put('/penjualan_item/{penjualan_item}', [PenjualanItemController::class, 'update'])->name('penjualan_item.update');
Route::delete('/penjualan_item/{penjualan_item}', [PenjualanItemController::class, 'destroy'])->name('penjualan_item.destroy');


require __DIR__.'/auth.php';

