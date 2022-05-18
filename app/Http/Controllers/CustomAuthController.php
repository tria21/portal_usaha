<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Hash;
use Session;

class CustomAuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }
    public function registration(){
        return view("auth.registration");
    }
    public function registrationOwnerForm(){
        return view("auth.registration-owner");
    }
    public function registrationUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = '2';
        $res = $user->save();
        event(new Registered($user));
        if ($res) {
            return back()->with('success', 'You have registered succesfuly. An email has been sent. Please check your inbox.');
        }else{
            return back()->with('fail', 'Something wrong');
        }
    }
    public function registrationOwner(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = '1';
        $res = $user->save();
        event(new Registered($user));
        if ($res) {
            return back()->with('success', 'You have registered succesfuly. An email has been sent. Please check your inbox.');
        }else{
            return back()->with('fail', 'Something wrong');
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
                $role = $user->role;
                if($role){
                    if($role=='3'){
                        return view('dashboard.dashboard-admin');
                    }else if($role=='1'){
                        return view('dashboard.dashboard-pemilik');
                    }else{
                        return view('dashboard.dashboard-pengunjung');
                    }
                }else{
                    return back()->with('fail','rolenya apa ges.');
                }
            }else{
                return back()->with('fail','Password not matches.');
            }
        }else{
            return back()->with('fail','The email is not registered.');
        }
    }

    public function profil(){
        $user = DB::select('select * from users where id = ?', [session('loginId')]);
        return view('pemilik.data-profil-pemilik', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $ubah = User::findorfail($id);

        $user = [
            'nama_usaha'    => $request['nama_usaha'],
            'name'          => $request['name'],
            'jenis_usaha'   => $request['jenis_usaha'],
            'alamat_usaha'  => $request['alamat_usaha'],
            'facebook'      => $request['facebook'],
            'instagram'     => $request['instagram'],
            'shopee'        => $request['shopee'],
            'tokopedia'     => $request['tokopedia']
        ];

        $image = $request->file('image');
        
        if ($image) {
            $namaFile = $image->getClientOriginalName(); 
            $user['image'] = $namaFile;
            $proses = $image->move('img/', $namaFile);
        }

        $ubah->update($user);
        return redirect('data-profil-pemilik');
    }

    public function update_password(Request $request, $id)
    {
        $ubah = User::findorfail($id);

        $user = [
            'password' => Hash::make($request['password']),
        ];

        $ubah->update($user);
        return redirect('data-profil-pemilik')->with('success', 'Password Berhasil Diubah!');
    }
}
