<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Validator;
class MemberController extends Controller
{
    public function login()
    {
        return view('customer.login');
    }

    public function loginProses(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = Member::where('email', $email)->first();

        if ($user && $user->password === md5($password)) {
            Auth::login($user);
            return redirect()->intended('/');
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function registrasi()
    {
        return view('customer.registrasi');
    }

    public function registrasiProses(Request $request)
    {
        $validation=Validator::make([
            'name'=>$request->name,
            'telepon'=>$request->telepon,
            'email'=>$request->email,
            'password'=>$request->password
        ],[
            'name' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:members',
            'password' => 'required',
        ]);
        // $request->validate([
        //     'name' => 'required',
        //     'telepon' => 'required',
        //     'email' => 'required|email|unique:members',
        //     'password' => 'required',
        // ]);

        if($validation->fails()){
            return back()->with('error','Registrasi gagal, silahkan periksa kembali data anda!');
        }

        $member = new Member();
        $member->nama = $request->name;
        $member->no_wa = $request->telepon;
        $member->email = $request->email;
        $member->password = md5($request->password);
        $member->save();

        return redirect('login')->with('success','Berhasil mendaftar');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}
