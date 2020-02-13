<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller
{
    public function index(){
       // in random order
     //  $productAll= Product::inRandomOrder('id','DESC')->get();
        $productAll= Product::orderBy('id','DESC')->where(['status'=>'1'])->get();
    $categorie=Category::with('categories')->where(['parent_id'=>0])->get();
    //    echo'<pre>';echo($categorie);die;  */
$banner=Banner::where(['status'=>'1'])->get();
        return view('index')->with(compact('productAll','categorie','banner'));
        }
    }

