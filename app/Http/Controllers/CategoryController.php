<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //
    public function addCategory(Request $request){
   if($request->isMethod('post')){
       $data= $request->all();
       //echo'<pre>';print_r($data);die;
       if(empty($data['enable'])){
           $status=0;
       }
       else {
           $status=1;
       }
       $category =new Category;
       $category->name=$data['name'];
       $category->parent_id=$data['parent_id'];
       $category->description=$data['desc'];
       $category->url=$data['url'];
       $category->status=$status;
       $category->save();
       return redirect('/admin/view-category')->with('flash_message_succ','Category add Successfully');
   }
        $levles =  Category::where(['parent_id'=>0])->get();
     return view('admin.category.add_category')->with(compact('levles'));
    }
    public function viewCategories(){
        $category =Category::get();
             return view('admin.category.view_category')->with(compact('category'));
    }
    public function editCategory(Request $request,$id){
        if($request->isMethod('post')){
            $data= $request->all();
           // echo'<pre>';print_r($data);die;
           if(empty($data['enable'])){
            $status=0;
        }
        else {
            $status=1;
        }
           Category::where(['id'=>$id])->update(['name'=>$data['name'],'description'=>$data['desc'],'url'=>$data['url'],'parent_id'=>$data['parent_id'],'status'=>$status]);
           return redirect('/admin/view-category')->with('flash_message_succ',' Edit Category  Successfully');
        }
        $levles =  Category::where(['parent_id'=>0])->get();
        $catdetails = Category::where(['id'=>$id])->first();
        return view('admin.category.edit_category')->with(compact('catdetails','levles'));
    }
    public function deleteCategory($id){
            if(!empty($id)){
                Category::where(['id'=>$id])->delete();
                return  redirect()->back()->with('flash_message_success','category has deleted success');


}
    }

}
