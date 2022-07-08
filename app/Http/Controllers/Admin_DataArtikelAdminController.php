<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenArtikel;
use App\Models\User;
use App\Models\Notifikasi;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\SweetAlertServiceProvider ;
use Illuminate\Support\Facades\DB;
use App\Exports\ArtikelAdminExport;
use App\Exports\ArtikelPemilikExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Session;
use Image;

class Admin_DataArtikelAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtArtikelAdmin = KontenArtikel::select("*")    
                        ->where('role', 3)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin-artikel-admin.data-artikel-admin', compact('dtArtikelAdmin', 'dtNotif', 'CountNotif'));
    }

    public function detail($id)
    {
        $dtArtikelAdmin = KontenArtikel::select("*")    
                        ->where('role', 3)
                        ->get();
        $dtArtikelID = DB::select('select * from konten_artikels where id = ?', [$id]);
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
       return view('admin-artikel-admin.detail-artikel-admin', compact('dtArtikelAdmin', 'dtArtikelID', 'dtNotif', 'CountNotif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin-artikel-admin.input-artikel-admin', compact('dtNotif', 'CountNotif'));
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
        $image_resize = Image::make($nm->getRealPath());
        $image_resize->resize(400, 400);

        $dtUpload = new KontenArtikel;
        $dtUpload->id_user          = session('loginId');
        $dtUpload->judul            = $request->judul;
        $dtUpload->gambar           = $namaFile;
        $dtUpload->caption_gambar   = $request->caption_gambar;
        $dtUpload->kategori         = $request->kategori;
        $dtUpload->isi_artikel      = $request->isi_artikel;
        $dtUpload->role             = $role->role;
        $dtUpload->penulis          = session('loginName');

        $image_resize->save('img/' .$namaFile , 80);
        $dtUpload->save();

        Alert::success('Data berhasil ditambahkan');
        
        return redirect('data-artikel-admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dtArtikelAdmin = KontenArtikel::findorfail($id);
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin-artikel-admin.edit-artikel-admin',compact('dtArtikelAdmin', 'dtNotif', 'CountNotif'));
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

        $dtArtikelAdmin = [
            'judul'             => $request['judul'],
            'gambar'            => $awal,
            'caption_gambar'    => $request['caption_gambar'],
            'kategori'          => $request['kategori'],
            'isi_artikel'       => $request['isi_artikel'],
        ];
        
        if ($request->hasFile('gambar')) {
            // $ubah->delete_image();
            $gambar = $request->file('gambar');
            $image_resize = Image::make($gambar->getRealPath());
            $image_resize->resize(400, 400);
            $image_resize->save('img/' .$awal , 80);
        }

        $ubah->update($dtArtikelAdmin);
        Alert::success('Data berhasil diubah');
        return redirect('data-artikel-admin');
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

    public function cetak_artikel_admin()
    {
        $cetakArAdmin = KontenArtikel::select("*")    
                        ->where('role', 3)
                        ->orderBy('created_at', 'desc')
                        ->get();
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
       return view('admin-artikel-admin.cetak-artikel-admin', compact('cetakArAdmin', 'dtNotif', 'CountNotif'));
    }

    public function cetak_artikel_admin_custom($tglawal, $tglakhir)
    {
        $cetakArAdminCustom = KontenArtikel::select("*")    
                        ->where('role', 3)
                        ->whereBetween('created_at',[$tglawal, $tglakhir])
                        ->orderBy('created_at', 'desc')
                        ->get();
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
       return view('admin-artikel-admin.cetak-artikel-admin-custom', compact('cetakArAdminCustom', 'dtNotif', 'CountNotif'));
    }

    public function export_excel_artikel_admin()
	{
		return Excel::download(new ArtikelAdminExport, 'artikel-admin.xlsx');
	}

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->cari;
 
		$dtArtikelAdmin = KontenArtikel::select("*")
                        ->where('role', 3)
                        ->where('judul', 'like', "%" . $keyword . "%")
                        // ->orWhere('kategori', 'like', "%" . $keyword . "%")
                        // ->orWhere('created_at', 'like', "%" . $keyword . "%")
                        ->paginate(10);
        $CountNotif = Notifikasi::select("*")    
                        ->where('is_read_admin', 0)
                        ->count();
        $dtNotif = DB::table('notifikasis')
                        ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                        ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                        ->select('notifikasis.*', 'komentars.nama_user')
                        ->where('is_read_admin', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
		return view('admin-artikel-admin.data-artikel-admin', compact('dtArtikelAdmin', 'dtNotif', 'CountNotif'));
	}

}
