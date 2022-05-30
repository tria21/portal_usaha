<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenArtikel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardPengunjungController extends Controller
{
    public function index()
    {
        $TampilArAdmin = KontenArtikel::select("*")    
                            ->where('role', 3)
                            ->orderBy('created_at', 'desc')
                            ->get();
        // dd($TampilArAdmin);
        $TampilAkMasy = User::where('id_user', [session('loginId')]);
        $dtGaleri = DB::select('select * from galeris');
        // $TampilArAdmin = $dtArtikelAdmin = DB::select('select * from konten_artikels where role = ?', '3');
        return view('dashboard.dashboard-pengunjung', compact('TampilAkMasy', 'TampilArAdmin', 'dtGaleri'));
    }

    public function readMore($id){
        $dtArtikelBeranda = KontenArtikel::all();
        $dtArtikelID = DB::select('select * from konten_artikels where id = ?', [$id]);
        return view('pengunjung.read-more-artikel-beranda', compact('dtArtikelBeranda', 'dtArtikelID'));
    }

    public function profilUsaha($id){
        $dtUserID = DB::select('select * from users where id = ?', [$id]);
        $dtArtikelID = DB::select('select * from konten_artikels where id_user = ?', [$id]);
        $dtSosmedID = DB::select('select * from sosmeds where id_user = ?', [$id]);
        return view('pengunjung.profil-usaha', compact('dtUserID', 'dtArtikelID', 'dtSosmedID'));
    }

    public function baseKategori($kategori){
        $dtArtikelKategori = DB::select('select * from konten_artikels where kategori = ?', [$kategori]);
        return view('pengunjung.tampil-artikel-kategori', compact('dtArtikelKategori'));
    }

    public function tampilArtikel(){
        $dtArtikel = DB::select('select * from konten_artikels');
        return view('pengunjung.tampil-all-artikel', compact('dtArtikel'));
    }

    public function tampilUsaha(){
        $TampilUsaha = User::select("*")    
                            ->where('role', 1)
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('pengunjung.tampil-all-usaha', compact('TampilUsaha'));
    }
}
