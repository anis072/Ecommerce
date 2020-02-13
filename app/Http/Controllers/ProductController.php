<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use App\Country;
use App\Product;
use App\ProductAttribute;
use Image;
use App\ImageProduct;
use DB;
use Session;
use App\Coupon;
use App\DeliveryAdress;
use App\ShippingAdress;
use App\User;
use Auth;

class ProductController extends Controller
{
    //
    public function addProduct(Request $request){
        if($request->isMethod('post')){
            $data =$request->all();
           $product = new Product;
           if(empty($data['category_id'])){
                return  redirect()->back()->with('flash_message_error','Under category field is empty !!');

           }
           $product->category_id=$data['category_id'];
           $product->products_name=$data['name'];
           $product->products_code=$data['code'];
           $product->products_color=$data['color'];
           if(!empty($data['desc'])){
           $product->description=$data['desc'];
           }else{
            $product->description='';
           }
           if(!empty($data['care'])){
            $product->care=$data['care'];
            }else{
             $product->care='';
            }
           $product->price=$data['price'];
           $product->status=$data['enable'];
           if($request->hasFile('image')){
               $image_tmp =$request->file('image');
               if($image_tmp->isValid()){
                   $extension =$image_tmp->getClientOriginalExtension();
                   $filename = rand(111,99999).'.'.$extension;
                   $large_image_path='img/backend_images/products/large/'.$filename;
                   $medium_image_path='img/backend_images/products/medium/'.$filename;
                   $samll_image_path='img/backend_images/products/small/'.$filename;
                   //Rezise image
                   Image::make($image_tmp)->save($large_image_path);
                   Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(300,300)->save($samll_image_path);
                   $product->image=$filename;
               }
           }
           $product->save();
           return redirect()->back()->with('flash_message_succ','Product add Successfully');

        }
        $categories= Category::where(['parent_id'=>0])->get();
        $category_dropdown = '<option selected value="" disabled>Select</option>';
        foreach($categories as $cat){
            $category_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_cat= Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_cat as $sub){
                $category_dropdown .= "<option value= '".$sub->id."'>&nbsp;--&nbsp;".$sub->name."</option>";
            }
        }
        return view('admin.product.add_product')->with(compact('category_dropdown'));
    }
    public function viewProducts(){
        $product= Product::get();
        foreach($product as $key => $val){
        $category_name= Category::where(['id'=>$val->category_id])->first();
        $product[$key]->category_name =$category_name->name;
        }
        return view('admin.product.view_product')->with(compact('product'));
    }
    public function editProduct(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['enable'])){
                $status=0;
            }
            else {
                $status=1;
            }
            if($request->hasFile('image')){
                $image_tmp =$request->file('image');
                if($image_tmp->isValid()){
                    $extension =$image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path='img/backend_images/products/large/'.$filename;
                    $medium_image_path='img/backend_images/products/medium/'.$filename;
                    $samll_image_path='img/backend_images/products/small/'.$filename;
                    //Rezise image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($samll_image_path);

                }
                else  $filename=$data['current_image'];
            }
               if(empty($data['description'])){
                   $data['description']='';
               }
               if(empty($data['care'])){
                $data['description']='';
            }
            Product::where(['id'=>$id])->update(['id'=>$data['product_id'],'products_name'=>$data['name'],'products_code'=>$data['code'],'products_color'=>$data['color']
            ,'description'=>$data['desc'],'care'=>$data['care'],'price'=>$data['price'],'image'=>$filename,'status'=>$status]);
            return redirect()->back();
        }
        $productdet= Product::where(['id'=>$id])->first();
        $categories= Category::where(['parent_id'=>0])->get();
        $category_dropdown = '<option selected  disabled>Select</option>';
      foreach($categories as $cat){
            if($cat->id == $productdet->category_id){
                $selected= "selected";
            }
            else{
                $selected ='';
            }
            $category_dropdown .= "<option value='".$cat->id."'".$selected." >".$cat->name."</option>";
            $sub_cat= Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_cat as $sub){
                if($sub->id==$productdet->category_id){
                    $selected= "selected";
                }
                else{
                    $selected ='';
                }
                $sub_cat .= "<option value= '".$sub->id."' ".$selected.">&nbsp;--&nbsp;".$sub->name."</option>";
            }
        }
        return view('admin.product.edit_product')->with(compact('productdet','category_dropdown'));
    }
    public function deleteImage($id){
        $productimage =Product::where(['id'=>$id])->first();
       $large_image_path = '/img/backend_images/products/large';
       $meduim_image_path = '/img/backend_images/products/medium';
       $small_image_path = '/img/backend_images/products/small';
       if(file_exists($large_image_path.$productimage->image)){
           unlink($large_image_path.$productimage->image);
       }
       if(file_exists($meduim_image_path.$productimage->image)){
        unlink($meduim_image_path.$productimage->image);
    }
    if(file_exists($small_image_path.$productimage->image)){
        unlink($small_image_path.$productimage->image);
    }
        Product::where(['id'=>$id])->update(['image'=>'']);

        return redirect()->back()->with('flash_message_succ','Image deleted successfully');
    }
    public function deleteProduct($id){
     Product::where(['id'=>$id])->delete();
     return redirect()->back()->with('flash_message_succ','Categorie deleted Successfully');
    }
    public function addAttribute(Request $request,$id){
        $productdet=Product::with('attribute')->Where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data =$request->all();
            foreach ($data['sku'] as $key => $val) {
                # code...
                if(!empty($val)){
                $productAtt=ProductAttribute::where('sku',$val)->count();
                if($productAtt>0){
                    return redirect()->back()->with('flash_message_error','Sku has been used !!');

                }
                }
                $attr=ProductAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                if($attr>0){
                    return redirect()->back()->with('flash_message_error','Size has been used !!');

                }
                $att  = new ProductAttribute;
                $att->product_id = $data['id'];
                $att->sku = $val;
                $att->size = $data['size'][$key];
                $att->price = $data['price'][$key];
                $att->stock = $data['stock'][$key];
                $att->save();
            }
            return redirect()->back()->with('flash_message_succ','Attributes added Successfully !!');
        }
        return view('admin.product.add_attribute')->with(compact('productdet'));
    }
    public function addImages(Request $request,$id){
        $productdet =Product::with('attribute')->where(['id'=>$id])->first();

        if($request->isMethod('post')){
            //   echo'<pre>';print_r($data);die;
               $data =$request->all();
               $image=new ImageProduct;

               if($request->hasFile('image')){
                $files =$request->file('image');
                foreach($files as $file){


                    $extension =$file->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path='img/backend_images/products/large/'.$filename;
                    $medium_image_path='img/backend_images/products/medium/'.$filename;
                    $samll_image_path='img/backend_images/products/small/'.$filename;
                    //Rezise image
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($samll_image_path);
                    $image->image = $filename;
                    $image->product_id=$data['id'];
                    $image->save();
                }

                }
                return redirect('admin/add-image/'.$id)->with('flash_messsage_succ','Images has been saved');
        }
        $productImage = ImageProduct::where(['product_id'=>$id])->get();



        return view('admin.product.add_image')->with(compact('productdet','productImage'));
    }
    public function deletealtProduct($id){
    $img=ImageProduct::where(['id'=>$id])->delete();
    return redirect()->back()->with('flash_messsage_succ','Images has been Deleted');
    }
    public function deleteAttribute(Request $request,$id){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_succ','Attribute deleted Successfully');
    }
    public function products($url){
           $count=Category::where(['name'=>$url,'status'=>"1"])->count();
           if($count==0){
               abort(404);
           }
        $categorie=Category::with('categories')->where(['parent_id'=>0])->get();
        $categorydet=Category::where(['name'=>$url])->first();
      if($categorydet->parent_id==0){
            $sub_cat=Category::where(['parent_id'=>$categorydet->id])->get();

            foreach($sub_cat as $sub){
                $cat_id [] = $sub->id;
            }

            $product=Product::whereIn('category_id',$cat_id)->get();

        }
        else {
        $product=Product::where(['category_id'=> $categorydet->id])->get();
        }
        return view('admin.product.listing')->with(compact('categorie','categorydet','product'));
    }
    public function product($id){
         $productstatus=Product::where(['id'=>$id,'status'=>1])->count();
         if($productstatus==0){
            abord(404);
         }
         $productdet=Product::with('attribute')->where(['id'=> $id])->first();
         $related_product=Product::where('id','!=',$id)->where(['category_id'=>$productdet->category_id])->get();
         $categorie=Category::with('categories')->where(['parent_id'=>0])->get();
         $productAttImage = ImageProduct::where(['product_id'=>$id]);
         $total_stock=ProductAttribute::where(['product_id'=>$id])->sum('stock');
         return view('admin.product.details')->with(compact('productdet','categorie','productAttImage','total_stock','related_product'));

    }
    public function editAttribute(Request $request,$id){
      if($request->isMethod('post')){
          $data =$request->all();
          foreach ($data['idAttr'] as $key => $attr) {
              # code...
             ProductAttribute::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
          }
          return redirect()->back()->with('flash_message_succ','Attributes Update Successfully');
        }

    }
    public function getAttrPrice(Request $request){
        $data =$request->all();
        $proatt= explode("-",$data['idsize']);
        $productatt=ProductAttribute::where(['product_id'=>$proatt[0],'size'=>$proatt[1]])->first();
        echo $productatt->price;
        echo "#";
        echo $productatt->size;

    }
    public function addToCart(Request $request){
      $request->session()->forget('Couponamount');
      $request->session()->forget('Couponcode');
        $data = $request->all();
        if(empty($data['user_email'])){
            $data['user_email']='';
        }
        if(empty($data['session_id'])){
            $data['session_id']='';
        }
        $session_id =Session::get('session_id');
        if(empty($session_id)){
        $session_id= str::random(40);
        Session::put('session_id',$session_id);
        }
        $size= explode("-",$data['size']);
        $countProduct=DB::table('cart')->where(['product_id'=>$data['id'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'product_size'=>$size[1],'quantity'=>$data['quantity'],'session_id'=>$session_id])->count();
         if($countProduct>0){
             return redirect()->back()->with('flash_message_error','Product Already exist in Cart');
         }
         else
         {
             $sku=ProductAttribute::select('sku')->where(['product_id'=>$data['id'],'size'=>$size[1]])->first();

        DB::table('cart')->insert(['product_id'=>$data['id'],'product_name'=>$data['product_name'],'product_code'=>$sku->sku,'product_color'=>$data['product_color'],'product_price'=>$data['product_price'],'product_size'=>$size[1],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
        return redirect('cart')->with('flash_message_succ','Product add Successfully');
         }
    }
    public function cart(){
        $session_id= Session::get('session_id');
        $usercart=DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach($usercart as $key=>$product){
            $productdet=Product::where(['id'=>$product->product_id])->first();
            $usercart[$key]->image=$productdet->image;
        }
        return view('admin.product.cart')->with(compact('usercart'));
    }
    public function deletePcart(Request $request,$id){
        $request->session()->forget('Couponamount');
        $request->session()->forget('Couponcode');
        Session::forget('Couponamount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect()->back()->with('flash_message_succ','Product Deleted Successfully');
    }
    function updateQuantity(Request $request,$id,$quantity){
        $request->session()->forget('Couponamount');
        $request->session()->forget('couponcode');

        $getCartDetails= DB::table('cart')->where('id',$id)->first();
        $atrStock=ProductAttribute::where('sku',$getCartDetails->product_code)->first();
        $up_quan= $getCartDetails->quantity+$quantity;
        if($atrStock->stock >= $up_quan){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect()->back()->with('flash_message_succ','Product has been update Successfully');

        }
        else {
                return redirect()->back()->with('flash_message_error','Product is not availble');
        }
            }
    function applyCode(Request $request){
        $request->session()->forget('Couponamount');
        $request->session()->forget('couponcode');

      $data =$request->all();
      $count= Coupon::where(['coupon_code'=>$data['couponcode']])->count();
      if($count==0){
          return redirect()->back()->with('flash_message_error','Coupon is Invalid pLease Enter Other Coupon Code');
      }
      else{


      $couponDetail=Coupon::where(['coupon_code'=>$data['couponcode']])->first();
      if($couponDetail->status==0){
        return redirect()->back()->with('flash_message_error','Coupon inActive Try other one !!');
          }
        $expiry_date=$couponDetail->expiry_date;
        $date= date('yy-mm-dd');
      if($expiry_date>$date){
        return redirect()->back()->with('flash_message_error','Coupon is Expired');

      }
      $session=Session::get('session_id');
      $usercart=DB::table('cart')->where(['session_id'=>$session])->get();
      $total_amount=0;
      foreach($usercart as $item){
      $total_amount =$total_amount+($item->product_price*$item->quantity);
      }
      if($couponDetail->amount_type=="Fixed"){
          $couponamount=$couponDetail->amount;
      }
      else {
          $couponamount= $total_amount*($couponDetail->amount/100);
      }

      //coupon w amount foset session
      $request->session()->put('Couponamount', $couponamount);
      $request->session()->put('Couponcode', $data['couponcode']);

      //Session::put('Couponcode',$data['couponcode']);
      return redirect()->back()->with('flash_message_succ','Coupon is Successfuly turn ,Your amount has been discounted ');

      }

    }
    public function checkout(Request $request){
        $user_id =Auth::User()->id;
        $user_email=Auth::User()->email;
        $user_details=User::where('id',$user_id)->first();
        $country=Country::get();
        $shipping_count=DeliveryAdress::where('id',$user_id)->count();
        if($shipping_count>0){
           $user_shipping=DeliveryAdress::where('id',$user_id)->first();
        }



    if($request->isMethod('post')){
        $data=$request->all();

        /* Update uset table with shipping form input*/
        if($shipping_count>0){
            $shipping=new DeliveryAdress;
            $shipping->user_id=$user_id;
            $shipping->user_email=$user_email;
            $shipping->name=$data['sname'];
            $shipping->adress=$data['aname'];
            $shipping->city=$data['cname'];

            $shipping->state=$data['country'];
            $shipping->pincode=$data['pname'];
            $shipping->mobile=$data['mname'];
            $shipping->save();
            return redirect()->back()->with('flash_succ_message','Checkout Successfully');
        }
        return redirect()->action('ProductController@orderReview');


      }
      $session_id=$request->session()->get('session_id');
      DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$user_email]);
      return view('admin.product.checkout')->with(compact('user_details','country','user_shipping'));
    }
    public function orderReview(){
        $user_id =Auth::User()->id;

        $user_email=Auth::User()->email;
        $user_details=User::where(['id'=>$user_id])->first();

        $shippingdetail=DeliveryAdress::where('user_id',$user_id)->first();
        return view('admin.product.orderview')->with(compact('user_details','shippingdetail'));
    }
}
