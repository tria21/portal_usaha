<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenArtikel;
use App\Models\User;
use App\Models\Komentar;
use Illuminate\Support\Facades\DB;
use App\Exports\ArtikelPemilikUsahaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class DashboardPemilikController extends Controller
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
        $CountArtikel = KontenArtikel::where('id_user', [session('loginId')])->count();
        // $CountKomentar = KontenArtikel::where('role', 1)->count();
        return view('dashboard.dashboard-pemilik', compact('CountArtikel'));
    }

    public function index_data_artikel()
    {
        $dtArtikelPemilik = KontenArtikel::select("*")    
                            ->where('id_user', session('loginId'))
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        // $dtArtikelPemilik = KontenArtikel::where('id_user', [session('loginId')])->orderBy('created_at', 'asc');
        // $dtArtikelPemilik = DB::select('select * from konten_artikels where id_user = ?', [session('loginId')])->orderBy('created_at', 'asc');
        return view('pemilik.data-artikel-pemilik', compact('dtArtikelPemilik'));
    }

    public function detail($id)
    {
        $dtArtikelPemilik = KontenArtikel::select("*")    
                            ->where('id_user', session('loginId'))
                            // ->orderBy('created_at', 'desc')
                            ->get();
        $dtArtikelID = DB::select('select * from konten_artikels where id = ?', [$id]);
        return view('pemilik.detail-artikel-pemilik', compact('dtArtikelPemilik', 'dtArtikelID'));
    }

    public function cetak_artikel_pemilik()
    {
        $cetakArPemilik = KontenArtikel::select("*")    
                        ->where('id_user', session('loginId'))
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('pemilik.cetak-artikel-pemilik', compact('cetakArPemilik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemilik.input-artikel-pemilik');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = User::find(session('loginId'));
        // dd($request->all());
        $nm = $request->gambar;
        $namaFile = time().rand(100,999).".".$nm->getClientOriginalExtension(); //memberi nama file dengan nomor acak

        $dtUpload = new KontenArtikel;
        $dtUpload->id_user          = session('loginId');
        $dtUpload->judul            = $request->judul;
        $dtUpload->gambar           = $namaFile;
        $dtUpload->caption_gambar   = $request->caption_gambar;
        $dtUpload->isi_artikel      = $request->isi_artikel;
        $dtUpload->kategori         = $request->kategori;
        $dtUpload->role             = $role->role;
        $dtUpload->penulis          = session('loginName');

        $nm->move('img/', $namaFile);
        $dtUpload->save();
        
        return redirect('data-artikel-pemilik');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dtArtikelPemilik = KontenArtikel::findorfail($id);
        return view('pemilik.edit-artikel-pemilik',compact('dtArtikelPemilik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ubah = KontenArtikel::findorfail($id);
        $awal = $ubah->gambar;

        $dtArtikelPemilik = [
            'judul'             => $request['judul'],
            'gambar'            => $awal,
            'caption_gambar'    => $request['caption_gambar'],
            'isi_artikel'       => $request['isi_artikel'],
            'kategori'       => $request['kategori']
        ];
        
        if ($request->hasFile('gambar')) {
            // $ubah->delete_image();
            $gambar = $request->file('gambar');
            $request->gambar->move('img/', $awal);
        }

        $ubah->update($dtArtikelPemilik);
        return redirect('data-artikel-pemilik');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $hapus = KontenArtikel::findorfail($id);

        $file = ('img/').$hapus->gambar;
        //cek jika ada gambar
        if (file_exists($file)){
            //maka hapus file dari folder img
            @unlink($file);
        }
        //hapus data drai db
        $hapus->delete();
        return back();
    }

    public function export_excel_artikel_pemilik()
	{
		return Excel::download(new ArtikelPemilikUsahaExport, 'artikel-pemilik-usaha.xlsx');
	}

    public function cari_artikel_pemilik(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$dtArtikelPemilik = KontenArtikel::select("*")
                        // ->where('role', 3)
                        ->where('judul', 'like', "%" . $keyword . "%")
                        ->orWhere('kategori', 'like', "%" . $keyword . "%")
                        ->orWhere('isi_artikel', 'like', "%" . $keyword . "%")
                        ->paginate(10);
 
		return view('pemilik.data-artikel-pemilik', compact('dtArtikelPemilik'));
 
	}

    public function index_komentar()
    {
        $dtKomentar = DB::table('komentars')
                        ->leftjoin('konten_artikels', 'komentars.id_artikel', '=', 'konten_artikels.id')
                        ->leftjoin('users', 'konten_artikels.id_user', '=', 'users.id')
                        ->select('komentars.nama_user', 'komentars.isi_komentar', 'konten_artikels.id_user', 'konten_artikels.judul')
                        ->where('konten_artikels.id', session('loginId'))
                        ->get();
        return view('pemilik.data-komentar', compact('dtKomentar'));
    }
}
