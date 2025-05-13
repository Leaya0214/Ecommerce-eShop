<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;


class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('backend.brand.index',compact('brands'));

    }

    public function store(Request $request){
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->logo) {
            $images = $request->file('logo');
            $customName = rand().".".$images->getClientOriginalExtension();
            $location = public_path('backend/brand/'.$customName);
            Image::make($images)->save($location);
           
        }

        $data = [
            'name' => $request->name,
            'logo' => $customName,
            'slug' => Str::slug($request->name),
        ];

        Brand::create($data);

        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $data = [
            'name' => $request->name,
            'logo' => $request->file('logo')->store('logos', 'public'),
            'slug' => Str::slug($request->name),
        ];

        Brand::update($data);

        return redirect()->route('backend.brand.index')->with('success', 'Brand updated successfully.');
    }


}
