<?php

namespace App\Http\Controllers;


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
        if ($res) {
            return back()->with('success', 'You have registered Succesfuly');
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
        if ($res) {
            return back()->with('success', 'You have registered Succesfuly');
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
}
