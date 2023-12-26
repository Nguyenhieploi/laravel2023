<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index(){ 
        return view('Auth.AuthLogin');
    }
    public function login(AuthRequest $request){
        $credentials =[
            'email' => $request->input('email'),
            'password' =>$request->input('password')
        ];
        
        if (Auth::attempt($credentials)) {
          return redirect()->route('dashboard.index')->with('success','Đăng nhập thanh công');
        }
        return redirect()->route('auth.admin')->with('error','Email hoặc mật khẩu không chính xác');
 
    }
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }
}
