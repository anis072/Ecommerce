<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    //
    public function addCoupon(Request $request){

        if($request->isMethod('post')){
            $data =$request->all();
            $coupon = new Coupon;
            if(empty($data['enable'])){
                $status=0;
            }
            else {
                $status=1;
            }
            $coupon->coupon_code=$data['couponcode'];
            $coupon->amount=$data['amount'];
            $coupon->amount_type=$data['amount_type'];
            $coupon->expiry_date=$data['exdate'];

            $coupon->status=$status;
            $coupon->save();
            return redirect()->action('CouponsController@viewCoupons')->with('flash_message_succ','Coupon added Successfully');

        }
        return view('admin.coupon.add_coupon')->with('flash_message_succ','Coupon added successfully');
    }
    public function viewCoupons(){
        $coupon =Coupon::get();
        return view('admin.coupon.view_coupon')->with(compact('coupon'));
    }
    public function editCoupon(Request $request,$id){
        if($request->isMethod('post')){
          $data =$request->all();
          $coupon=Coupon::find($id);
          $coupon->coupon_code=$data['couponcode'];
          $coupon->amount=$data['amount'];
          $coupon->amount_type=$data['amount_type'];
          $coupon->expiry_date = $data['exdate'];

          if($data['status']=""){
              $data['status']=0;
            }

          $coupon->status=$data['status'];
          $coupon->save();
          return redirect()->action('CouponsController@viewCoupons')->with('flash_message_succ','Coupon updated Successfully');

         }
        $coupon=Coupon::find($id);
        return view('admin.coupon.edit_coupon')->with(compact('coupon'));
    }
    public function deleteCoupon($id){
     Coupon::where(['id'=>$id])->delete();
     return redirect()->back()->with('flash_message_succ','Coupon deleted Successfully');
    }
}
