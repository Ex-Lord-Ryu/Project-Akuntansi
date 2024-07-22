<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getData(Request $request)
    {
        $years = explode(',', $request->query('years', date('Y')));
    
        $data = array_map(function ($year) {
            return [
                'year' => $year,
                'monthly' => DB::table('stok')
                    ->select(DB::raw('YEAR(tgl_penerimaan) as year, MONTH(tgl_penerimaan) as month, COUNT(*) as count'))
                    ->whereYear('tgl_penerimaan', $year)
                    ->groupBy('year', 'month')
                    ->get(),
                'yearly' => DB::table('stok')
                    ->select(DB::raw('YEAR(tgl_penerimaan) as year, COUNT(*) as count'))
                    ->whereYear('tgl_penerimaan', $year)
                    ->groupBy('year')
                    ->get(),
            ];
        }, $years);
    
        return response()->json($data);
    }    
}
