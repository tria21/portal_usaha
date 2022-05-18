<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.dashboard-admin');
    }

    public function index_akun_masyarakat()
    {
        $dtMas = DB::select('select * from users where role = ?', ['2']);
        return view('admin.data-akun-masyarakat', compact('dtMas'));
    }

    public function index_akun_pemilik()
    {
        $dtUsaha = DB::select('select * from users where role = ?', ['1']);
        return view('admin.data-akun-pemilik-usaha', compact('dtUsaha'));
    }

    public function index_artikel_usaha()
    {
        return view('admin.data-artikel-usaha');
    }
}
