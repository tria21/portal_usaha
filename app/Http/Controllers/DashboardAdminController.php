<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KontenArtikel;
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
        $CountAkPemilik = User::where('role', 1)->count();
        $CountAkMasy = User::where('role', 2)->count();
        $CountArAdmin = KontenArtikel::where('role', 3)->count();
        $CountArPemilik = KontenArtikel::where('role', 1)->count();
        return view('dashboard.dashboard-admin', compact('CountAkPemilik', 'CountAkMasy', 'CountArAdmin', 'CountArPemilik'));
    }

    public function index_akun_masyarakat()
    {
        $dtMas = User::select("*")    
                ->where('role', 2)
                ->orderBy('created_at', 'desc')
                ->get();
        // $dtMas = User::where('id', ['2'])->orderBy('created_at', 'asc');
        return view('admin.data-akun-masyarakat', compact('dtMas'));
    }

    public function index_akun_pemilik()
    {
        $dtUsaha = User::select("*")    
                ->where('role', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        // $dtUsaha = User::where('id', ['1'])->orderBy('created_at', 'asc');
        return view('admin.data-akun-pemilik-usaha', compact('dtUsaha'));
    }

    public function detail_akun_pemilik()
    {
        $dtUsaha = User::select("*")    
                ->where('role', 1)
                ->get();
        return view('admin.detail-akun-pemilik-usaha', compact('dtUsaha'));
    }

    public function index_artikel_usaha()
    {
        $dtArtikelPemilik = KontenArtikel::select("*")    
                            ->where('role', 1)
                            ->orderBy('created_at', 'desc')
                            ->get();
        // $dtArtikelPemilik = KontenArtikel::where('id', ['1'])->orderBy('created_at', 'asc');
        return view('admin.data-artikel-usaha', compact('dtArtikelPemilik'));
    }

    public function detail_artikel_usaha()
    {
        $dtArtikelPemilik = KontenArtikel::select("*")    
                            ->where('role', 1)
                            ->get();
        return view('admin.detail-artikel-usaha', compact('dtArtikelPemilik'));
    }
}
