<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Logic for user dashboard
        return view('dashboard');
    }

    // public function getAdminData(Request $request)
    // {
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

    //     return view('admin.dashboard', compact('userCount', 'adminCount', 'penjualanCount', 'penjualanMonthly', 'filter'));
    // }
}
