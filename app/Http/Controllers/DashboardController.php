<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stok;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stokGrouped = Stok::where('status', 'available')
            ->where('harga', '>', 0)
            ->get()
            ->groupBy('barang.nama');

        // Fetch other necessary data
        $adminCount = User::where('usertype', 'admin')->count();
        $userCount = User::where('usertype', 'user')->count();
        $penjualanCount = Penjualan::count();

        // Pass the data to the view
        return view('dashboard', compact('stokGrouped', 'adminCount', 'userCount', 'penjualanCount'));
    }
    // public function admin(Request $request)
    // {

    //     $stokGrouped = Stok::where('status', 'available')
    //         ->where('harga', '>', 0)
    //         ->get()
    //         ->groupBy('barang.nama');

    //     // Fetch other necessary data
    //     $adminCount = User::where('usertype', 'admin')->count();
    //     $userCount = User::where('usertype', 'user')->count();
    //     $penjualanCount = Penjualan::count();


    //     $stokAvailable = Stok::where('status', 'available')->get();

    //     $stokGrouped = $stokAvailable->groupBy('barang.nama')->map(function ($items) {
    //         $latestPrice = $items->sortByDesc('created_at')->first()->harga;
    //         $colors = $items->pluck('warna.warna')->unique()->implode(', ');

    //         return [
    //             'colors' => $colors,
    //             'latestPrice' => $latestPrice,
    //             'items' => $items,
    //         ];
    //     });

    //     $userCount = User::where('usertype', 'user')->count();
    //     $adminCount = User::where('usertype', 'admin')->count();

    //     $filter = $request->query('filter', 'year'); // Default filter is 'year'
    //     $currentDate = Carbon::now();

    //     if ($filter === 'year') {
    //         $penjualanCount = Penjualan::whereYear('created_at', $currentDate->year)->count();
    //         $penjualanMonthly = Penjualan::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
    //             ->whereYear('created_at', $currentDate->year)
    //             ->groupBy('year', 'month')
    //             ->get();
    //     } elseif ($filter === 'month') {
    //         $penjualanCount = Penjualan::whereYear('created_at', $currentDate->year)
    //             ->whereMonth('created_at', $currentDate->month)
    //             ->count();
    //         $penjualanMonthly = Penjualan::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day, COUNT(*) as count')
    //             ->whereYear('created_at', $currentDate->year)
    //             ->whereMonth('created_at', $currentDate->month)
    //             ->groupBy('year', 'month', 'day')
    //             ->get();
    //     } else { // Daily filter
    //         $penjualanCount = Penjualan::whereDate('created_at', $currentDate->toDateString())->count();
    //         $penjualanMonthly = Penjualan::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day, HOUR(created_at) as hour, COUNT(*) as count')
    //             ->whereDate('created_at', $currentDate->toDateString())
    //             ->groupBy('year', 'month', 'day', 'hour')
    //             ->get();
    //     }

    //     return view('dashboard', compact('userCount', 'adminCount', 'penjualanCount', 'penjualanMonthly', 'filter', 'stokGrouped', 'adminCount', 'userCount', 'penjualanCount'));
    // }

    public function adminIndex(Request $request)
    {
        $filter = $request->get('filter', 'year');

    if ($filter === 'year') {
        $penjualanMonthly = DB::table('penjualan')
            ->select(DB::raw('YEAR(tgl_penjualan) as year, MONTH(tgl_penjualan) as month, COUNT(*) as count'))
            ->groupBy(DB::raw('YEAR(tgl_penjualan), MONTH(tgl_penjualan)'))
            ->orderByRaw('YEAR(tgl_penjualan) DESC, MONTH(tgl_penjualan) DESC')
            ->get();
    } elseif ($filter === 'month') {
        $penjualanMonthly = DB::table('penjualan')
            ->select(DB::raw('YEAR(tgl_penjualan) as year, MONTH(tgl_penjualan) as month, DAY(tgl_penjualan) as day, COUNT(*) as count'))
            ->groupBy(DB::raw('YEAR(tgl_penjualan), MONTH(tgl_penjualan), DAY(tgl_penjualan)'))
            ->orderByRaw('YEAR(tgl_penjualan) DESC, MONTH(tgl_penjualan) DESC, DAY(tgl_penjualan) DESC')
            ->get();
    } elseif ($filter === 'day') {
        $penjualanMonthly = DB::table('penjualan')
            ->select(DB::raw('YEAR(tgl_penjualan) as year, MONTH(tgl_penjualan) as month, DAY(tgl_penjualan) as day, HOUR(tgl_penjualan) as hour, COUNT(*) as count'))
            ->groupBy(DB::raw('YEAR(tgl_penjualan), MONTH(tgl_penjualan), DAY(tgl_penjualan), HOUR(tgl_penjualan)'))
            ->orderByRaw('YEAR(tgl_penjualan) DESC, MONTH(tgl_penjualan) DESC, DAY(tgl_penjualan) DESC, HOUR(tgl_penjualan) DESC')
            ->get();
    }

    $adminCount = User::where('usertype', 'admin')->count();
    $userCount = User::where('usertype', 'user')->count();
    $penjualanCount = Penjualan::count();

    return view('admin.dashboard', compact('adminCount', 'userCount', 'penjualanCount', 'penjualanMonthly', 'filter'));
    }

    public function userDashboard()
    {

        $stokGrouped = Stok::where('status', 'available')
            ->where('harga', '>', 0)
            ->get()
            ->groupBy('barang.nama');

        // Fetch other necessary data
        $adminCount = User::where('usertype', 'admin')->count();
        $userCount = User::where('usertype', 'user')->count();
        $penjualanCount = Penjualan::count();


        $stokAvailable = Stok::where('status', 'available')->get();

        $stokGrouped = $stokAvailable->groupBy('barang.nama')->map(function ($items) {
            $latestPrice = $items->sortByDesc('created_at')->first()->harga;
            $colors = $items->pluck('warna.warna')->unique()->implode(', ');

            return [
                'colors' => $colors,
                'latestPrice' => $latestPrice,
                'items' => $items,
            ];
        });

        // Pass the data to the view
        return view('dashboard', compact('stokGrouped', 'adminCount', 'userCount', 'penjualanCount'));
    }
}
