<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Frontend\AddtoCart;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Cupon;
use Illuminate\Support\Facades\Session;

class AddtoCartController extends Controller
{
    // public function addtocart($id){
    //     $productinfo= Product::find($id);
    //     $userID = Auth::user()->id;

    //     $addtocart = new AddtoCart;
    //     $addtocart->user_id = Auth::user()->id;
    //     $addtocart->product_id = $productinfo->id;
    //     $addtocart->name = $productinfo->product_name;
    //     $addtocart->price = $productinfo->product_price;
    //     $addtocart->image = $productinfo->thumbnails;
    //     $addtocart->quantity = 1;
    //     $addtocart->save();
    //     return response()->json([
    //         "status"=>"success"
    //     ]);
    // }

    public function addtocart($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['status'=>"error","message"=>"Product Not Found"]);
        }

        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                "id" => $product->id,
                "name"=>$product->product_name,
                "quantity"=>1,
                "price"=>$product->product_price,
                "discount"=>$product->discount ?? 0,
                "image"=>$product->thumbnails
            ];
        }
        session()->put('cart',$cart);

        return response()->json([
            'status' => "success"
        ]);
    }
    
    public function showcartitems(){
        $items = count(session('cart'));
        // dd($items);
        return response()->json([
            "items"=> $items
        ]);

    }
    public function showitem(){
        $items = session()->get('cart');
        return response()->json([
            "items"=> $items
        ]);
    }
    public function removeitem($id){
        $items = session()->get('cart');
        if(isset($items[$id])){
            unset($items[$id]);
        }
        Session::put('cart', $items);
        return response()->json([
            "status"=> "success"
        ]);
    }
    public function viewcart(){
        $items = Session::get('cart');
        if(!$items){
            return redirect()->route('home')->with("error","Your cart is empty");
        }
        $categories = Category::Where("status",1)->get();

        return view("frontend.pages.viewcart", compact("items","categories"));
    }
    public function coupon($coupon){
        $items = Cupon::where("cupon_code", $coupon)->first();
        return response()->json([
            "data"=>$items
        ]);
    }
}
