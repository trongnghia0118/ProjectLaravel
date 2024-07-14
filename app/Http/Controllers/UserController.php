<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class UserController extends Controller
{
  public function login(){
    return view('user');
  }
    public function register(){
     return view('user');
    }

    public function postregister(Request $req){
      $email = $req->input('email');
      $name = $req->input('name');
      $pass = $req->input('pass');
      $repass = $req->input('repass');
      if($pass!=$repass){
        return back()->withErrors([
          'email' => 'PassWord Không Trùng Khớp',
      ])->withInput();
      }
      $user = User::where('email', $email)->first();
      if(isset($user)){
        return back()->withErrors([
            'email' => 'Email đã tồn tại',
        ])->withInput();
      }
      $user = new User();
      $user->name = $name;
      $user->email = $email;
      $user->password = $pass;
      $user->save();
      return redirect()->route('register');
    }
    public function postlogin(Request $req){
        $email = $req->input('email');
        $password = $req->input('pass');
        $remember = $req->input('remember');

        $user = User::where('email',$email)->first();
        if(isset($user)){
            $canLog = Hash::check($password, $user->password);
        }
        if($canLog){
            Auth::login($user, $remember);
            return redirect()->route('home');
        }else{
          Session::flash('success_message', 'Cập nhật trạng thái đơn hàng thành công!');
          return redirect()->route('admin.order');
        }
    }

}
