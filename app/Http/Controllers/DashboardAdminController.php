<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sosmed;
use App\Models\KontenArtikel;
use App\Models\Beranda;
use App\Models\Galeri;
use App\Models\Komentar;
use App\Models\Notifikasi;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PemilikExport;
use App\Exports\MasyarakatExport;
use App\Exports\ArtikelPemilikExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Session;
use Image;

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
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('dashboard.dashboard-admin', compact('CountAkPemilik', 'CountAkMasy', 'CountArAdmin', 'CountArPemilik', 'dtNotif', 'CountNotif'));
    }

    public function index_akun_masyarakat()
    {
        $dtMas = User::select("*")    
                ->where('role', 2)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                ->where('is_read_admin', 0)
                ->count();
        $dtNotif = DB::table('notifikasis')
                ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                ->where('is_read_admin', 0)
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin.data-akun-masyarakat', compact('dtMas', 'dtNotif', 'CountNotif'));
    }

    public function cetak_akun_masyarakat()
    {
        $cetakAkMasy = User::select("*")    
                        ->where('role', 2)
                        ->orderBy('created_at', 'desc')
                        ->get();
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin.cetak-akun-masyarakat', compact('cetakAkMasy', 'dtNotif', 'CountNotif'));
    }

    public function export_excel_masyarakat()
	{
		return Excel::download(new MasyarakatExport, 'akun-masyarakat.xlsx');
	}

    public function index_akun_pemilik()
    {
        $dtUsaha = User::select("*")    
                ->where('role', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                ->where('is_read_admin', 0)
                ->count();
        $dtNotif = DB::table('notifikasis')
                ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                ->where('is_read_admin', 0)
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin.data-akun-usaha', compact('dtUsaha', 'dtNotif', 'CountNotif'));
    }

    public function detail_akun_pemilik($id)
    {
        $dtUsaha = User::select("*")    
                ->where('role', 1)
                ->get();
        $dtSosmed = Sosmed::select("*")    
                ->where('id_user', [$id])
                ->get();
        $dtAkunID = DB::select('select * from users where id = ?', [$id]);
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.detail-akun-usaha', compact('dtUsaha', 'dtSosmed', 'dtAkunID', 'dtNotif', 'CountNotif'));
    }

    public function cetak_akun_pemilik()
    {
        $cetakAkUsaha = User::select("*")    
                ->where('role', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        $CountNotif = Notifikasi::select("*")    
                ->where('is_read_admin', 0)
                ->count();
        $dtNotif = DB::table('notifikasis')
                ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                ->where('is_read_admin', 0)
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin.cetak-akun-usaha', compact('cetakAkUsaha', 'dtNotif', 'CountNotif'));
    }

    public function export_excel_pemilik()
	{
		return Excel::download(new PemilikExport, 'akun-pemilik-usaha.xlsx');
	}

    public function cari_akun_pemilik(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$dtUsaha = User::select("*")
		                ->where('role','1')
                        ->where('name', 'like', "%" . $keyword . "%")
                        ->orWhere('nama_usaha', 'like', "%" . $keyword . "%")
                        ->orWhere('jenis_usaha', 'like', "%" . $keyword . "%")
                        ->orWhere('alamat_usaha', 'like', "%" . $keyword . "%")
                        ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
 
		return view('admin.data-akun-usaha', compact('dtUsaha', 'dtNotif', 'CountNotif'));
	}

    public function index_artikel_usaha()
    {
        $dtArtikelPemilik = KontenArtikel::select("*")    
                            ->where('role', 1)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.data-artikel-usaha', compact('dtArtikelPemilik', 'dtNotif', 'CountNotif'));
    }

    public function detail_artikel_usaha($id)
    {
        $dtArtikelPemilik = KontenArtikel::select("*")    
                            ->where('role', 1)
                            ->get();
        $dtArtikelID = DB::select('select * from konten_artikels where id = ?', [$id]);
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.detail-artikel-usaha', compact('dtArtikelPemilik', 'dtArtikelID', 'dtNotif', 'CountNotif'));
    }

    public function cetak_artikel_usaha()
    {
        $cetakArPemilik = KontenArtikel::select("*")    
                            ->where('role', 1)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $CountNotif = Notifikasi::select("*")    
                            ->where('is_read_admin', 0)
                            ->count();
        $dtNotif = DB::table('notifikasis')
                            ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                            ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                            ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                            ->where('is_read_admin', 0)
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('admin.cetak-artikel-usaha', compact('cetakArPemilik', 'dtNotif', 'CountNotif'));
    }

    public function export_excel_artikel_usaha()
	{
		return Excel::download(new ArtikelPemilikExport, 'artikel-pemilik-usaha-admin.xlsx');
	}

    public function cari_artikel_usaha(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$dtArtikelPemilik = KontenArtikel::select("*")
                		->where('role','1')
                        ->where('judul', 'like', "%" . $keyword . "%")
                        ->orWhere('kategori', 'like', "%" . $keyword . "%")
                        ->orWhere('penulis', 'like', "%" . $keyword . "%")
                        ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
		return view('admin.data-artikel-usaha', compact('dtArtikelPemilik', 'dtNotif', 'CountNotif'));
	}

    public function cari_galeri(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$dtGaleri = Galeri::select("*")
                        // ->where('role', 3)
                        ->where('caption_gambar', 'like', "%" . $keyword . "%")
                        ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
		return view('admin.data-beranda', compact('dtGaleri', 'dtNotif', 'CountNotif'));
	}

    public function index_data_beranda()
    {   
        $dtGaleri = Galeri::select("*")
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.data-beranda', compact('dtGaleri', 'dtNotif', 'CountNotif'));
    }

    public function index_data_tentang()
    {   
        $dtBeranda = Beranda::all();
        $dtCekBeranda = Beranda::get();
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.data-tentang', compact('dtBeranda', 'dtCekBeranda', 'dtNotif', 'CountNotif'));
    }

    public function edit_data_beranda($id)
    {
        $dtBeranda = Beranda::findorfail($id);
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.edit-beranda',compact('dtBeranda', 'dtNotif', 'CountNotif'));
    }

    public function update_data_beranda(Request $request, $id)
    {
        $ubah = Beranda::findorfail($id);

        $dtBeranda = [
            'isi_beranda'           => $request['isi_beranda'],
            'deskripsi_tambahan'    => $request['deskripsi_tambahan'],
        ];

        $ubah->update($dtBeranda);
        Alert::success('Data berhasil diubah');
        return redirect('data-tentang');
    }

    public function create_galeri()
    {
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.input-galeri', compact('dtNotif', 'CountNotif'));
    }

    public function create_tentang()
    {
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.input-tentang', compact('dtNotif', 'CountNotif'));
    }
    
    public function store_tentang(Request $request)
    {
        $request->validate([
            'isi_beranda'=>'required',
            'deskripsi_beranda'=>'required'
        ]);
        $dtUpload = new Beranda;
        $dtUpload->isi_beranda          = $request->isi_beranda;
        $dtUpload->deskripsi_tambahan   = $request->deskripsi_tambahan;

        $dtUpload->save();

        Alert::success('Data berhasil ditambahkan');
        
        return redirect('data-tentang');
    }

    public function store_galeri(Request $request)
    {
        $request->validate([
            'image'=>'required',
            'caption_gambar'=>'required',
        ]);
        
        $nm = $request->image;
        $namaFile = time().rand(100,999).".".$nm->getClientOriginalExtension(); //memberi nama file dengan nomor acak
        $image_resize = Image::make($nm->getRealPath());
        $image_resize->resize(400, 300);

        $dtUpload = new Galeri;
        $dtUpload->image           = $namaFile;
        $dtUpload->caption_gambar  = $request->caption_gambar;

        $image_resize->save('img/' .$namaFile , 80);
        $dtUpload->save();

        Alert::success('Data berhasil ditambahkan');
        
        return redirect('data-beranda');
    }

    public function edit_galeri($id)
    {
        $dtGaleri = Galeri::findorfail($id);
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.edit-galeri',compact('dtGaleri', 'dtNotif', 'CountNotif'));
    }

    public function update_galeri(Request $request, $id)
    {
        $ubah = Galeri::findorfail($id);
        $awal = $ubah->image;

        $dtGaleri = [
            'image '            => $awal,
            'caption_gambar'    => $request['caption_gambar'],
        ];
        
        if ($request->hasFile('image')) {
            // $ubah->delete_image();
            $image = $request->file('image');
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400, 300);
            $image_resize->save('img/' .$awal , 80);
        }

        $ubah->update($dtGaleri);
        Alert::success('Data berhasil diubah');
        return redirect('data-beranda');
    }

    public function destroy_galeri($id)
    {
        // dd($id);
        $hapus = Galeri::findorfail($id);

        $file = ('img/').$hapus->gambar;
        //cek jika ada gambar
        if (file_exists($file)){
            //maka hapus file dari folder img
            @unlink($file);
        }
        //hapus data drai db
        $hapus->delete();
        // return back();
        return redirect('data-beranda');
    }

    public function index_komentar()
    {
        $dtKomentar = Komentar::all();
        $CountNotif = Notifikasi::select("*")    
                    ->where('is_read_admin', 0)
                    ->count();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                    ->where('is_read_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.data-komentar', compact('dtKomentar', 'dtNotif', 'CountNotif'));
    }

    public function cari_komentar(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$dtKomentar = Komentar::select("*")
                        ->where('nama_user', 'like', "%" . $keyword . "%")
                        ->orWhere('isi_komentar', 'like', "%" . $keyword . "%")
                        ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.judul')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
		return view('admin.data-komentar', compact('dtKomentar', 'dtNotif', 'CountNotif'));
	}
}
