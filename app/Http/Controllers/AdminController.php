<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showlogin(){
        return view('admin/admin/login');
    }

    public function dologin(){
        $post = \request()->except('_token');
        $post['admin_pwd'] = md5($post['admin_pwd']);
        $res = Admin::where($post)->first();
//        dd($res);
        if($res){
            request()->session()->put('admin',$res);
            return redirect('goods/list');
        }
            return redirect('showlogin')->with(['msg'=>'用户名或密码错误']);
    }

    public function logout(){
        request()->session()->put('admin',null);
        return redirect('showlogin');
    }
//    public function session1(){
//        request()->session()->put(['key1'=>'小明1']);
//        // Session::put(['key2'=>'小明2']);
//        // Session::flush();  //删除所有的session
//    }
//    public function session2(){
//        $data = request()->session()->get('key1');
//        dump($data);
//    }
}
