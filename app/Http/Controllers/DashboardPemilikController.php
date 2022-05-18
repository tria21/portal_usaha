<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenArtikel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        return view('dashboard.dashboard-pemilik');
    }

    public function index_data_artikel()
    {
        $dtArtikelPemilik = DB::select('select * from konten_artikels where id_user = ?', [session('loginId')]);
        return view('pemilik.data-artikel-pemilik', compact('dtArtikelPemilik'));
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
        $dtUpload->role             = $role->role;

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
            'isi_artikel'       => $request[session('loginId')],
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
}
