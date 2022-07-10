<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Sosmed;
use Hash;
use Session;
use Image;

class CustomAuthController extends Controller
{
    public function landingPage(){
        return view("dashboard.landing-page");
    }
    public function login(){
        return view("auth.login");
    }
    public function registration(){
        return view("auth.registration");
    }
    public function registrationOwnerForm(){
        return view("auth.registration-owner");
    }
    public function reload(){
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function registrationUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'captcha'=>'required|captcha'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = '2';
        $res = $user->save();
        event(new Registered($user));
        if ($res) {
            return back()->with('success', 'Registrasi berhasil! Periksa kotak masuk email anda untuk melakukan verifikasi');
            // return back()->with('success', 'You have registered succesfuly. An email has been sent. Please check your inbox.');
        }else{
            return back()->with('fail', 'Registrasi gagal');
        }
    }
    public function registrationOwner(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'captcha'=>'required|captcha'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = '1';
        $res = $user->save();
        event(new Registered($user));
        if ($res) {
            return back()->with('success', 'Registrasi berhasil! Periksa kotak masuk email anda untuk melakukan verifikasi');
            // return back()->with('success', 'You have registered succesfuly. An email has been sent. Please check your inbox.');
        }else{
            return back()->with('fail', 'Registrasi gagal');
        }
    }
    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);
        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId',$user->id);
                $request->session()->put('loginName',$user->name);
                $request->session()->put('loginRole',$user->role);
                $role = $user->role;
                if($role){
                    if($role=='3'){
                        return redirect()->route('dashboard-admin');
                    }else if($role=='1'){
                        return redirect()->route('dashboard-pemilik-usaha');
                    }else{
                        return redirect()->route('dashboard-pengunjung');
                    }
                }else{
                    return back()->with('fail','Role tidak terdeteksi.');
                }
            }else{
                return back()->with('fail','Password salah.');
            }
        }else{
            return back()->with('fail','Email salah');
        }
    }
    public function forgotPassword(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );


        return $status === Password::RESET_LINK_SENT
                ? back()->with('success', 'Periksa kotak masuk atau spam pada email anda untuk melanjutkan proses reset password')
                : back()->withErrors(['email' => __($status)]);
    }
    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', 'Reset password berhasil! Silahkan lakukan login')
                    : back()->withErrors(['email' => [__($status)]]);
    }
    public function profil(){
        $user = DB::select('select * from users where id = ?', [session('loginId')]);
        $dtSosmed = Sosmed::select("*")    
                    ->where('id_user', session('loginId'))
                    ->orderBy('created_at', 'desc')
                    ->get();
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user')
                    ->where('konten_artikels.id_user', session('loginId'))
                    ->where('is_read_pemilik', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        $CountNotif = DB::table('notifikasis')
                            ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                            ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                            ->select('notifikasis.*', 'komentars.nama_user')
                            ->where('konten_artikels.id_user', session('loginId'))
                            ->where('is_read_pemilik', 0)
                            ->count();

        return view('pemilik.data-profil-pemilik', compact('user', 'dtSosmed', 'dtNotif', 'CountNotif'));
    }

    public function update(Request $request, $id)
    {
        $ubah = User::findorfail($id);

        $user = [
            'nama_usaha'    => $request['nama_usaha'],
            'name'          => $request['name'],
            'jenis_usaha'   => $request['jenis_usaha'],
            'alamat_usaha'  => $request['alamat_usaha']
        ];

        $image = $request->file('image');
        
        if ($image) {
            $namaFile = $image->getClientOriginalName(); 
            $user['image'] = $namaFile;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save('img/' .$namaFile , 80);
        }

        $ubah->update($user);
        Alert::success('Data berhasil diubah');
        return redirect('data-profil-pemilik');
    }

    public function update_password(Request $request, $id)
    {
        $ubah = User::findorfail($id);

        $user = [
            'password' => Hash::make($request['password']),
        ];

        $ubah->update($user);
        Alert::success('Data berhasil diubah');
        return redirect('data-profil-pemilik')->with('success', 'Password Berhasil Diubah!');
    }

    public function create_sosmed()
    {
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user')
                    ->where('konten_artikels.id_user', session('loginId'))
                    ->where('is_read_pemilik', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        $CountNotif = DB::table('notifikasis')
                            ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                            ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                            ->select('notifikasis.*', 'komentars.nama_user')
                            ->where('konten_artikels.id_user', session('loginId'))
                            ->where('is_read_pemilik', 0)
                            ->count();
        return view('pemilik.input-sosmed', compact('dtNotif', 'CountNotif'));
    }

    public function store_sosmed(Request $request)
    {
        $dtUpload = new Sosmed;
        $dtUpload->id_user          = session('loginId');
        $dtUpload->nama_sosmed      = $request->nama_sosmed;
        $dtUpload->link_sosmed      = $request->link_sosmed;
        $dtUpload->save();
        
        Alert::success('Data berhasil ditambahkan');
        return redirect('data-profil-pemilik');
    }

    public function edit_sosmed($id)
    {
        $dtSosmed = Sosmed::findorfail($id);
        $dtNotif = DB::table('notifikasis')
                    ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                    ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                    ->select('notifikasis.*', 'komentars.nama_user')
                    ->where('konten_artikels.id_user', session('loginId'))
                    ->where('is_read_pemilik', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
        $CountNotif = DB::table('notifikasis')
                            ->join('konten_artikels', 'notifikasis.id_artikel', '=', 'konten_artikels.id')
                            ->join('komentars', 'notifikasis.id_komentar', '=', 'komentars.id')
                            ->select('notifikasis.*', 'komentars.nama_user')
                            ->where('konten_artikels.id_user', session('loginId'))
                            ->where('is_read_pemilik', 0)
                            ->count();
        return view('pemilik.edit-sosmed',compact('dtSosmed', 'dtNotif', 'CountNotif'));
    }

    public function update_sosmed(Request $request, $id)
    {
        $ubah = Sosmed::findorfail($id);

        $dtSosmed = [
            'nama_sosmed'   => $request['nama_sosmed'],
            'link_sosmed'   => $request['link_sosmed']
        ];

        $ubah->update($dtSosmed);
        Alert::success('Data berhasil diubah');
        return redirect('data-profil-pemilik');
    }

    public function destroy($id)
    {
        // dd($id);
        $hapus = Sosmed::findorfail($id);

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
