<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenArtikel;
use App\Models\User;
use App\Models\Komentar;
use App\Models\Beranda;
use App\Models\Notifikasi;
use App\Models\Sosmed;
use App\Models\Galeri;
use Illuminate\Support\Facades\DB;
use Session;
use Hash;

class DashboardPengunjungController extends Controller
{
    public function index()
    {
        $TampilArAdmin  = KontenArtikel::select("*")    
                            ->where('role', 3)
                            ->orderBy('created_at', 'desc')
                            ->skip(0)
                            ->take(6)
                            ->get();
        // dd($TampilArAdmin);
        $TampilAkMasy    = User::select("*")    
                            ->where('id', session('loginId'))
                            ->get();
        $dtGaleri       =  Galeri::select("*")    
                            ->orderBy('created_at', 'desc')
                            ->skip(0)
                            ->take(6)
                            ->get();
        return view('dashboard.dashboard-pengunjung', compact('TampilAkMasy', 'TampilArAdmin', 'dtGaleri'));
    }

    public function readMore($id){
        $dtArtikelBeranda = KontenArtikel::select("*")    
                            ->orderBy('created_at', 'desc')
                            ->skip(0)
                            ->take(5)
                            ->get();
        $dtArtikelID      = KontenArtikel::select("*")    
                            ->where('id', $id)
                            ->get();
        $dtArtikelIDU      = KontenArtikel::select("id_user")    
                            ->where('id', $id)
                            ->firstOrFail();
        $dtKomentar       = Komentar::select("*")    
                            ->where('id_artikel', $id)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $TampilAkun       = User::select("*")    
                            ->where('id', session('loginId'))
                            ->get();
        if(session('loginRole') =='3'){
            $ubah = Notifikasi::where('id_artikel', $id);
                    
            $dtRead = [
                'is_read_admin'     => 1,
            ];

            $ubah->update($dtRead);
        }elseif(session('loginRole') =='1'){
            $ubah = Notifikasi::where('id_artikel', $id);
                    
            $dtRead = [
                'is_read_pemilik'   => 1,
            ];

            $ubah->update($dtRead);
        }
        return view('pengunjung.read-more-artikel-beranda', compact('TampilAkun', 'dtArtikelBeranda', 'dtArtikelID', 'dtArtikelIDU', 'dtKomentar', 'id'));
    }

    public function profilUsaha($id){
        $dtUserID    = DB::select('select * from users where id = ?', [$id]);
        $dtArtikelID = KontenArtikel::select("*")    
                        ->where('id_user', $id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        $dtSosmedID  = Sosmed::select("*")    
                        ->where('id_user', [$id])
                        ->whereNotIn('nama_sosmed', ['google maps', 'Google maps', 'Google Maps'])
                        ->get();
        $dtSosmedMaps = Sosmed::select("*")    
                        ->where('id_user', [$id])
                        ->where('nama_sosmed', ['google maps', 'Google maps', 'Google Maps'])
                        ->get();
        return view('pengunjung.profil-usaha', compact('dtUserID', 'dtArtikelID', 'dtSosmedID', 'dtSosmedMaps'));
    }

    public function baseKategori($kategori){
        $dtArtikelKategori = KontenArtikel::select("*")    
                            ->where('kategori', [$kategori])
                            ->orderBy('created_at', 'desc')
                            ->paginate(9);
        return view('pengunjung.tampil-artikel-kategori', compact('dtArtikelKategori'));
    }

    public function baseKategoriUsaha($kategori){
        $dtUsahaKategori = User::select("*")    
                            ->where('jenis_usaha', [$kategori])
                            ->orderBy('created_at', 'desc')
                            ->paginate(9);
        return view('pengunjung.tampil-usaha-kategori', compact('dtUsahaKategori'));
    }

    public function tampilArtikel(){
        // $dtArtikel = DB::select('select * from konten_artikels');
        $dtArtikel = KontenArtikel::select("*")    
                            ->orderBy('created_at', 'desc')
                            ->paginate(9);
        return view('pengunjung.tampil-all-artikel', compact('dtArtikel'));
    }

    public function tampilUsaha(){
        $TampilUsaha = User::select("*")    
                            ->where('role', 1)
                            ->orderBy('created_at', 'desc')
                            ->paginate(9);
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

        $dtUpload2 = new Notifikasi;
        $dtUpload2->id_artikel            = $request->id;
        $dtUpload2->id_komentar           = $dtUpload->id;
        $dtUpload2->is_read_admin         = $request->is_read_admin;
        $dtUpload2->is_read_pemilik       = $request->is_read_pemilik;

        $dtUpload2->save();
        
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

    public function tampilTentang(){
        $dtTentang = Beranda::all();
        return view('pengunjung.tampil-tentang', compact('dtTentang'));
    }
    
    public function updateAkun(Request $request, $id)
    {
        $ubah = User::findorfail($id);

        $dtAkun = [
            'name'              => $request['name'],
            'email'             => $request['email'],
            'password'          => Hash::make($request['password']),
        ];

        $ubah->update($dtAkun);
        return redirect('edit-akun-pengunjung')->with('success', 'Password berhasil diubah!');;
    }

    public function EditAkun(){
        $dtAkun = User::select("*")    
                    ->where('id', session('loginId'))
                    ->get();
        return view('pengunjung.edit-akun', compact('dtAkun'));
    }

    public function cari_artikel(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$dtArtikel = KontenArtikel::select("*")
                    ->where('judul', 'like', "%" . $keyword . "%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);
        
        return view('pengunjung.tampil-all-artikel', compact('dtArtikel'));
    }

    public function cari_usaha(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$TampilUsaha = User::select("*")
                    ->where('nama_usaha', 'like', "%" . $keyword . "%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);
        
        return view('pengunjung.tampil-all-usaha', compact('TampilUsaha'));
    }
}