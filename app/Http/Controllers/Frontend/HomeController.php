<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use App\Models\Backend\Product;

class HomeController extends Controller
{
    public function categorySearch(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::where('name', 'LIKE', "%{$search}%")->get();
        $products   = Product::where('cat_id', $request->id)->get();
        return view('frontend.category_search', compact('categories'));
    }

    public function quickview($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

}
