<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function listing(){
        $url = Route::getFacadeRoot()->current()->uri();
        $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
        if($categoryCount>0){
            //Get Category Details
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);
            $categoryProducts = Product::whereIn('category_id',$categoryDetails['catIds'])->where('status',1)->get()->toArray();
            // dd($categoryProducts);
            //  echo "Category exists"; die;
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }else{
             abort(404);
        }

    }
}
