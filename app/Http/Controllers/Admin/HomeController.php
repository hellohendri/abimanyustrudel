<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductionHistory;

class HomeController extends Controller
{
    public function index()
    {
        $admiko_data['sideBarActive'] = "home";
        $admiko_data['sideBarActiveFolder'] = "";

        $totalCost = 0;
        $tableData = ProductionHistory::orderByDesc("tanggal_produksi")->get();
        foreach ($tableData as $cost) {
            $totalCost += $cost->hpp * $cost->jumlah;
        }

        return view('admin.home.index')->with(compact('admiko_data', "totalCost"));
    }
}
