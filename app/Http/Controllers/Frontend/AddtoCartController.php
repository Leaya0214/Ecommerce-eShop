<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
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

        $email = 'leayasultana@gmail.com';
        $emailData = [
            'subject' => 'Welcome to our website',
            'name' => 'Leaya Sultana',
            'message' => 'Thank you for joining us!'
        ];
        // SendMailJob::dispatch($email,$emailData);

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


    public function updatecart(Request $request){
        $cart = session()->get('cart');
        if(isset($cart[$request->id])){
            $cart[$request->id]['quantity'] = $request->quantity;
        }
        session()->put('cart',$cart);
        $item = $cart[$request->id];
        $item['total'] = $item['quantity'] * $item['price'];
        $subtotal = 0;
        foreach($cart as $key =>$value){
            $subtotal += $value['quantity'] * $value['price'];
        }
         return response()->json([
            "status"=>"success",
            "itemTotal" => $item['total'],
            "subTotal" =>$subtotal
        ]);
    }


        public function applyCoupon(Request $request)
        {
            $couponCode = $request->input('coupon_code');
            $coupon = Cupon::where('cupon_code', $couponCode)->where('status', 1)->first();

            if (!$coupon) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired coupon.'
                ]);
            }

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cart is empty.'
                ]);
            }

            $discountAmount = 0;
            $subtotal = 0;

            foreach ($cart as $key => $item) {
                $subtotal += $item['quantity'] * $item['price'];
            }

            if ($coupon->discount_type == 'percent') {
                $discountAmount = ($subtotal * $coupon->discount) / 100;
            } else {
                $discountAmount = $coupon->discount;
            }

            session()->put('cart_discount', [
                'code' => $coupon->cupon_code,
                'amount' => $discountAmount
            ]);

            $total = $subtotal - $discountAmount;

            return response()->json([
                'status' => 'success',
                'discount' => $discountAmount,
                'total' => $total,
                'coupon' => $coupon->cupon_code
            ]);
        }
    
}
