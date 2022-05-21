<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPengunjungController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard-pengunjung');
    }
}
