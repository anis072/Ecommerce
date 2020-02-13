<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use Illuminate\Http\Request;
use Auth;
use Hash;
class UsersController extends Controller
{
    //*
    public function  userLoginRegister(){
          return view('user.register_login');
    }
    public function register(Request $request){
        if($request->isMethod('post')){
            $data =$request->all();
            $usercount =User::where(['email'=>$data['email']])->count();
            if($usercount>0){
                return redirect()->back()->with('flash_message_error','User is Already Exist');
            }else {
                $user = new User;
                $user->name=$data['name'];
                $user->email=$data['email'];
                $user->password= bcrypt($data['myPassword']);
                $user->save();
               if(Auth::attempt([ 'email' => $data['email'], 'password' => $data['myPassword']])){
                $request->session()->put('frontsession',$data['email']);
               return redirect('/cart');
                  }


            }


        }

    }
    public function checkEmail(Request $request){
        $data =$request->all();
            $usercount =User::where(['email'=>$data['email']])->count();
            if($usercount>0){
                echo "false";

            }
            else {
                echo "true";



    }
}
public function login(Request $request ){
    if($request->isMethod('post')){
        $data=$request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            $request->session()->put('frontsession',$data['email']);
            return redirect('/cart');


        }
        else{
            return redirect()->back()->with('flash_message_error','Email or password Incorrect');
        }
    }

}
public function account(Request $request){
    $countries = Country::get();
     $user_id=Auth::user()->id;
     $userDetails=User::find($user_id);
  if($request->isMethod('post')){
      $data =$request->all();
      $user =User::find($user_id);
      $user->name=$data['name'];
      $user->adress=$data['adress'];
      $user->city=$data['city'];
      $user->state=$data['state'];
      $user->country=$data['country'];
      $user->pincode=$data['pincode'];
      $user->mobile=$data['mobile'];
      $user->save();
      return redirect()->back()->with('flash_message_succ','Your deatils Has been updated');
  }
    return view('user.account')->with(compact('countries','userDetails'));
}
public function checkpass(Request $request){

           $data=$request->all();
            $c_pass=$data["c_pass"];
            $user_id=Auth::User()->id;
            $c_passe=User::where('id',$user_id)->first();
            if(Hash::check($c_pass, $c_passe->password)){
                echo "true";die;
            }
            else {
                echo "false";die;
            }

}
public function updatepass(Request $request){
    if($request->isMethod('post')){
        $data =$request->all();
        $c_pass=$data["c_pass"];
        $old_pass=User::where('id',Auth::User()->id)->first();
        if(Hash::check($c_pass,$old_pass->password)){
                  $new_pass=$data["n_pass"];
                  $new_passe=bcrypt($new_pass);
                  User::where('id',Auth::User()->id)->update(['password'=>$new_passe]);
                  return redirect()->back()->with('flash_message_succ','Password Update Successfully');
        }
        else{
            redirect()->back()->with('flash_message_error','Password Incorrect');
        }
    }
}

public function logout(Request $request){
    Auth::logout();
    $request->session()->forget('frontsession');
    return redirect('/');
}
}
