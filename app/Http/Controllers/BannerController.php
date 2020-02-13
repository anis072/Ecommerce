<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    //
    public function addBanner(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            $banner = new Banner;
            if($request->hasFile('image')){

                $image_tmp =$request->file('image');

                if($image_tmp->isValid()){
                    $extension =$image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path='img/frontend_images/dummy/'.$filename;


                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);

                    $banner->image=$filename;
                }
            }
            $banner->title=$data['title'];
            $banner->link=$data['link'];
            if(empty($data['enable'])){
                $status=0;
            }
            else {
                $status=1;
            }




            $banner->status=$status;
            $banner->save();
            return redirect()->back()->with('flash_message_succ','banner add Successfully');
        }
        return view('admin.banner.add_banner');
    }
    public function viewBanner(){
        $banner =Banner::get();
        return view('admin.banner.view_banner')->with(compact('banner'));

    }
    public function editBanner(Request $request,$id){
        if($request->isMethod('post')){
            $data =$request->all();

            if($request->hasFile('image')){
                echo'test';
                $image_tmp =$request->file('image');
                if($image_tmp->isValid()){
                    $extension =$image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path='img/frontend_images/dummy/'.$filename;

                    //Rezise image

                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);


                }
                else if(!empty($data['current_image'])) {$filename = $data['current_image'];
                echo $filename;}
                else {
                    $filename='';
                }

        }
        if(empty($data['enable'])){
            $status=0;
        }
        else {
            $status=1;
        }
        if(empty($data['title'])){
            $data['title']='';
        }
        if(empty($data['link'])){
            $data['link']='';
        }

        Banner::where('id',$id)->update(['image'=>$filename,'title'=>$data['title'],'link'=>$data['link'],'status'=>$data['enable']]);
          return redirect()->back()->with('flash_message_succ','Banner update _successfully');
    }
        $bannerdet= Banner::find($id);
        return view('admin.banner.edit_banner')->with(compact('bannerdet'));

}
public function deleteBanner($id){
 Banner::where(['id'=>$id])->delete();
return redirect()->back()->with('flash_message_succ','Banner updated Successfully');

}
}
