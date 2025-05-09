<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use App\Models\Backend\Slider;
use App\Models\Backend\Vendor;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Product;

class Home extends Controller
{
    public function index(){
        session()->forget('cart');
        session()->forget('coupon');
        $categories = Category::Where("status",1)->get();
        $sliders = Slider::Where("status",1)->get();
        $products = Product::Where("status",1)->get();
        $latest_products = Product::Where("status",1)->orderBy('id','desc')->take(10)->get();
        return view("frontend.home", compact("categories","sliders","products","latest_products"));
    }
}
