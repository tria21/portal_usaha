<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenArtikel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exports\ArtikelAdminExport;
use App\Exports\ArtikelPemilikExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class Admin_DataArtikelAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dtArtikelAdmin = KontenArtikel::where('role', 3)->orderBy('created_at', 'asc');
        // $dtArtikelAdmin = DB::select('select * from konten_artikels where id_user = ?', [session('loginId')]);
        $dtArtikelAdmin = KontenArtikel::select("*")    
                        ->where('role', 3)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin-artikel-admin.data-artikel-admin', compact('dtArtikelAdmin'));
    }

    public function detail($id)
    {
        $dtArtikelAdmin = KontenArtikel::select("*")    
                        ->where('role', 3)
                            // ->orderBy('created_at', 'desc')
                        ->get();
        $dtArtikelID = DB::select('select * from konten_artikels where id = ?', [$id]);
       return view('admin-artikel-admin.detail-artikel-admin', compact('dtArtikelAdmin', 'dtArtikelID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-artikel-admin.input-artikel-admin');
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
        $dtUpload->kategori         = $request->kategori;
        $dtUpload->isi_artikel      = $request->isi_artikel;
        $dtUpload->role             = $role->role;
        $dtUpload->penulis          = session('loginName');

        $nm->move('img/', $namaFile);
        $dtUpload->save();
        
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
        return view('admin-artikel-admin.edit-artikel-admin',compact('dtArtikelAdmin'));
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
            $request->gambar->move('img/', $awal);
        }

        $ubah->update($dtArtikelAdmin);
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
       return view('admin-artikel-admin.cetak-artikel-admin', compact('cetakArAdmin'));
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
                        // ->where('role', 3)
                        ->where('judul', 'like', "%" . $keyword . "%")
                        ->orWhere('kategori', 'like', "%" . $keyword . "%")
                        ->get();
                        // ->paginate(5);
 
		return view('admin-artikel-admin.data-artikel-admin', compact('dtArtikelAdmin'));
	}

}
