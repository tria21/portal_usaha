<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenArtikel;
use App\Models\User;
use App\Models\Komentar;
use Illuminate\Support\Facades\DB;

class DashboardPengunjungController extends Controller
{
    public function index()
    {
        $TampilArAdmin  = KontenArtikel::select("*")    
                            ->where('role', 3)
                            ->orderBy('created_at', 'desc')
                            ->get();
        // dd($TampilArAdmin);
        $TampilAkMasy    = User::select("*")    
                            ->where('id', session('loginId'))
                            ->get();
        $dtGaleri = DB::select('select * from galeris');
        // $TampilArAdmin = $dtArtikelAdmin = DB::select('select * from konten_artikels where role = ?', '3');
        return view('dashboard.dashboard-pengunjung', compact('TampilAkMasy', 'TampilArAdmin', 'dtGaleri'));
    }

    public function readMore($id){
        $dtArtikelBeranda = KontenArtikel::all();
        $dtArtikelID      = KontenArtikel::select("*")    
                            ->where('id', $id)
                            ->get();
        $dtKomentar       = Komentar::select("*")    
                            ->where('id_artikel', $id)
                            ->get();
        $TampilAkun       = User::select("*")    
                            ->where('id', session('loginId'))
                            ->get();
        return view('pengunjung.read-more-artikel-beranda', compact('TampilAkun', 'dtArtikelBeranda', 'dtArtikelID', 'dtKomentar', 'id'));
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

    public function store_komentar(Request $request, $id)
    {
        $ArtikelKomentar = KontenArtikel::find($id);
        $dtUpload = new Komentar;
        $dtUpload->id_user               = session('loginId');
        $dtUpload->nama_user             = session('loginName');
        $dtUpload->id_artikel            = $request->id;
        $dtUpload->id_komentar_utama     = $request->id_komentar_utama;
        $dtUpload->isi_komentar          = $request->isi_komentar;

        $dtUpload->save();
        
        return $this->readMore($id);
        // return redirect()->action('DashboardPengunjungController@readMore', ['id']);
    }

    public function destroy_komen($id)
    {
        // dd($id);
        $hapus = Komentar::findorfail($id);

        $hapus->delete();
        return back();
    }
}
