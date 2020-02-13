<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Session;
use App\User;
use  Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function login(Request $request){
        if($request->isMethod('post')){
            $data  = $request->input();
          /** */ // if(Auth::attempt(['email' => $data['email'] , 'password' => $data['password'] ,'admin' => '1']))
           // {
                Session::put('sessionEmail',$data['email']);
            return redirect('/admin/dashbord');

            //}
            //else{
           return redirect('/admin')->with('','Invalid Email or Password');
            //}
        }
        return view('admin.admin_login');
    }
    public function dashbord(){
       /** if(Session::has('sessionEmail')){

        }
        else {
            return redirect('/admin')->with('flash_message_error','Please Log in to access');
        }*/
      return view('admin.dashbord');
    }

    public function logout(){
        Session()->flush();
        return redirect('/admin')->with('flash_message_succ','Log out Successfully');
    }
    public function setting(){


   return view('admin.setting');
    }
    public function checkpwd(Request $request){
        $data = $request->all();
        $current_pwd =$data['current_pwd'];
        $chek_password = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_pwd,$chek_password)){
            echo "true";die;
        }
        else {
            echo "false";die;
        }
    }
    public function updatePwd(Request $request){

           if($request->isMethod('post')){
            $data =$request->all();
           $check_pwd=User::where(['email'=>Auth::user()->email])->first();
           $current_pwd=$data['new_pwd'];
           if(Hash::check($current_pwd, $check_pwd->password)){
               $password = bcrypt($data['new_pwd']);
               User::where('id','1')->update(['password'=>$password]);
               return redirect('/admin/setting')->with('flash_message_succ','Password Update Successfully');
           }
           else{
           return redirect('/admin/setting')->with('flash_message_error','Incorrect Password');
           }
       }
      // echo '<pre>'; dd($data);die;
    }
}
