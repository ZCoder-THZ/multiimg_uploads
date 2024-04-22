<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    //
    public function createProduct(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();
            $imageUrls = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = $image->store('posts', 'public');

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->url = $filename;
                    $productImage->save();
                    $imageUrls[] = $filename;
                }
            }
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
