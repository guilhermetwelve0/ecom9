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
            $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);


            //checking for Sort
            if(isset($_GET['sort']) && !empty($_GET['sort'])){
              if($_GET['sort'] == "product_latest"){
                $categoryProducts->orderby('products.id', 'Desc');
              }else if($_GET['sort'] == "price_lowest"){
                $categoryProducts->orderby('products.product_price', 'Asc');
              }else if($_GET['sort'] == "price_highest"){
                $categoryProducts->orderby('products.product_price', 'Desc');
              }
            }

            $categoryProducts = $categoryProducts->paginate(30);
            // dd($categoryDetails);
            // echo "Category exists"; die;
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }else{
             abort(404);
        }
    }
}
