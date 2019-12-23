<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function login(Request $request) {
   	if($request->isMethod('post')){
   		$data = $request->input();
   		if(Auth::attempt(['email'=>$data['login-email'], 'password'=>$data['login-password'], 'admin'=>'1'])){
   			return redirect('/admin/dashboard');
   		} else {
            return redirect('/admin')
               -> with('flash_massage_error', 'Email hoặc mật khẩu không đúng');
         }
   	}
   	return view('admin.admin_login');
   }

   public function logout()
   {
      Session::flush();
      return redirect('/admin')
         -> with('flash_massage_success', 'Đăng xuất thành công !');
   }

   public function dashboard()
   {
      return view('admin.dashboard');
   }
}
