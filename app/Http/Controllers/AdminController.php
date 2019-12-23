<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function login(Request $request) {
   	if($request->isMethod('post')){
   		$data = $request->input();
   		var_dump($data);
   		if(Auth::attempt(['email'=>$data['login-email'], 'password'=>$data['login-password'], 'admin'=>'1'])){
   			
   		}
   	}
   	return view('admin.admin_login');
   }
}
