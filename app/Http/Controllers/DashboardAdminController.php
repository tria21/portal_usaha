<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sosmed;
use App\Models\KontenArtikel;
use App\Models\Beranda;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PemilikExport;
use App\Exports\MasyarakatExport;
use App\Exports\ArtikelPemilikExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

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

    public function export_excel_masyarakat()
	{
		return Excel::download(new MasyarakatExport, 'akun-masyarakat.xlsx');
	}

    public function index_akun_pemilik()
    {
        $dtUsaha = User::select("*")    
                ->where('role', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin.data-akun-usaha', compact('dtUsaha'));
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
        return view('admin.detail-akun-usaha', compact('dtUsaha', 'dtSosmed', 'dtAkunID'));
    }

    public function cetak_akun_pemilik()
    {
        $cetakAkUsaha = User::select("*")    
                ->where('role', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin.cetak-akun-usaha', compact('cetakAkUsaha'));
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
                        // ->where('role', 3)
                        ->where('name', 'like', "%" . $keyword . "%")
                        ->orWhere('nama_usaha', 'like', "%" . $keyword . "%")
                        ->orWhere('jenis_usaha', 'like', "%" . $keyword . "%")
                        ->orWhere('alamat_usaha', 'like', "%" . $keyword . "%")
                        ->get();
                        // ->paginate(5);
 
		return view('admin.data-akun-usaha', compact('dtUsaha'));
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

    public function export_excel_artikel_usaha()
	{
		return Excel::download(new ArtikelPemilikExport, 'artikel-pemilik-usaha-admin.xlsx');
	}

    public function cari_artikel_usaha(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$dtArtikelPemilik = KontenArtikel::select("*")
                        // ->where('role', 3)
                        ->where('judul', 'like', "%" . $keyword . "%")
                        ->orWhere('kategori', 'like', "%" . $keyword . "%")
                        ->orWhere('penulis', 'like', "%" . $keyword . "%")
                        ->get();
                        // ->paginate(5);
 
		return view('admin.data-artikel-usaha', compact('dtArtikelPemilik'));
	}

    public function index_data_beranda()
    {   
        $dtBeranda = Beranda::all();
        $dtGaleri = Galeri::all();
        return view('admin.data-beranda', compact('dtBeranda', 'dtGaleri'));
    }

    public function edit_data_beranda($id)
    {
        $dtBeranda = Beranda::findorfail($id);
        return view('admin.edit-beranda',compact('dtBeranda'));
    }

    public function update_data_beranda(Request $request, $id)
    {
        $ubah = Beranda::findorfail($id);

        $dtBeranda = [
            'isi_beranda'           => $request['isi_beranda'],
            'deskripsi_tambahan'    => $request['deskripsi_tambahan'],
        ];

        $ubah->update($dtBeranda);
        return redirect('data-beranda');
    }

    public function create_galeri()
    {
        return view('admin.input-galeri');
    }

    public function store_galeri(Request $request)
    {
        $nm = $request->image;
        $namaFile = time().rand(100,999).".".$nm->getClientOriginalExtension(); //memberi nama file dengan nomor acak

        $dtUpload = new Galeri;
        $dtUpload->image           = $namaFile;
        $dtUpload->caption_gambar  = $request->caption_gambar;

        $nm->move('img/', $namaFile);
        $dtUpload->save();
        
        return redirect('data-beranda');
    }

    public function edit_galeri($id)
    {
        $dtGaleri = Galeri::findorfail($id);
        return view('admin.edit-galeri',compact('dtGaleri'));
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
            $request->image->move('img/', $awal);
        }

        $ubah->update($dtGaleri);
        return redirect('data-beranda');
    }

    public function destroy_galeri($id)
    {
        // dd($id);
        $hapus = Galeri::findorfail($id);

        $file = ('img/').$hapus->image;
        //cek jika ada gambar
        if (file_exists($file)){
            //maka hapus file dari folder img
            @unlink($file);
        }
        //hapus data drai db
        $hapus->delete();
        return back();
    }
}
