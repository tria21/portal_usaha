<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sosmed;
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

    public function cetak_akun_masyarakat()
    {
        $cetakAkMasy = User::select("*")    
                        ->where('role', 2)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin.cetak-akun-masyarakat', compact('cetakAkMasy'));
    }

    public function index_akun_pemilik()
    {
        $dtUsaha = User::select("*")    
                ->where('role', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin.data-akun-usaha', compact('dtUsaha'));
    }

    public function detail_akun_pemilik()
    {
        $dtUsaha = User::select("*")    
                ->where('role', 1)
                ->get();
        $dtSosmed = Sosmed::select("*")    
                ->where('id_user', [session('loginId')])
                ->get();
        // = DB::select('select * from sosmeds where id_user = ?', [session('loginId')]);

        return view('admin.detail-akun-usaha', compact('dtUsaha', 'dtSosmed'));
    }

    public function cetak_akun_pemilik()
    {
        $cetakAkUsaha = User::select("*")    
                ->where('role', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin.cetak-akun-usaha', compact('cetakAkUsaha'));
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

    public function detail_artikel_usaha($id)
    {
        $dtArtikelPemilik = KontenArtikel::select("*")    
                            ->where('role', 1)
                            ->get();
        $dtArtikelID = DB::select('select * from konten_artikels where id = ?', [$id]);
        return view('admin.detail-artikel-usaha', compact('dtArtikelPemilik', 'dtArtikelID'));
    }

    public function cetak_artikel_usaha()
    {
        $cetakArPemilik = KontenArtikel::select("*")    
                            ->where('role', 1)
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('admin.cetak-artikel-usaha', compact('cetakArPemilik'));
    }
}
