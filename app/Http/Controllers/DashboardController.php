<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\PenjualanItem;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $userCount = User::where('usertype', 'user')->count();
        $adminCount = User::where('usertype', 'admin')->count();
        
        $filter = $request->query('filter', 'year'); // Default filter is 'year'
        $currentDate = Carbon::now();

        if ($filter === 'year') {
            $penjualanCount = Penjualan::whereYear('created_at', $currentDate->year)->count();
            $penjualanMonthly = Penjualan::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', $currentDate->year)
                ->groupBy('year', 'month')
                ->get();
        } elseif ($filter === 'month') {
            $penjualanCount = Penjualan::whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->count();
            $penjualanMonthly = Penjualan::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day, COUNT(*) as count')
                ->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->groupBy('year', 'month', 'day')
                ->get();
        } else { // Daily filter
            $penjualanCount = Penjualan::whereDate('created_at', $currentDate->toDateString())->count();
            $penjualanMonthly = Penjualan::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day, HOUR(created_at) as hour, COUNT(*) as count')
                ->whereDate('created_at', $currentDate->toDateString())
                ->groupBy('year', 'month', 'day', 'hour')
                ->get();
        }

        return view('admin.dashboard', compact('userCount', 'adminCount', 'penjualanCount', 'penjualanMonthly', 'filter'));
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