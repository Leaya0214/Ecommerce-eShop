<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Frontend\AddtoCart;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Cupon;

class AddtoCartController extends Controller
{
    public function addtocart($id){
        $productinfo= Product::find($id);
        $addtocart = new AddtoCart;
        $addtocart->user_id = Auth::user()->id;
        $addtocart->product_id = $productinfo->id;
        $addtocart->name = $productinfo->product_name;
        $addtocart->price = $productinfo->product_price;
        $addtocart->image = $productinfo->thumbnails;
        $addtocart->quantity = 1;
        $addtocart->save();
        return response()->json([
            "status"=>"success"
        ]);
    }
    
    public function showcartitems(){
        $items = AddtoCart::where("user_id",Auth::user()->id)->count();
        return response()->json([
            "items"=> $items
        ]);

    }
    public function showitem(){
        $items = AddtoCart::where("user_id",Auth::user()->id)->get();
        return response()->json([
            "items"=> $items
        ]);

    }
    public function removeitem($id){
        $items = AddtoCart::find($id);
        $items->delete();
        return response()->json([
            "status"=> "success"
        ]);
    }
    public function viewcart(){
        $items = AddtoCart::where("user_id", Auth::user()->id)->get();
        return view("frontend.pages.viewcart", compact("items"));
    }
    public function coupon($coupon){
        $items = Cupon::where("cupon_code", $coupon)->first();
        return response()->json([
            "data"=>$items
        ]);
    }
}
