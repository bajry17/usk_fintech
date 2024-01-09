<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function add()
    {
        $categories = Category::all();

        return view("add_product", compact("categories"));
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $stock = $request->stock;
        $photo = $request->photo;
        $desc = $request->description;
        $category_id = $request->category_id;
        $stand = $request->stand;

        // $datetime = date("Y-m-d H:i:s");
        // $namafile = 'public/' .$name. $datetime;

        // move_uploaded_file($request->photo->pathname, "$namafile");

        $product = Product::create([
            "name"=> $name,
            "price"=> $price,
            "stock"=> $stock,
            "photo"=> $photo,
            "desc"=> $desc,
            "category_id"=> $category_id,
            "stand"=> $stand
        ]);

        // return redirect()->back()->with("status", "Berhasil menambah produk");
        return response()->json([
            'message'=>'Berhasil Menambah Porduk',
            'status'=>200,
            'data'=>$product
        ]);
    }
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $price = $request->price;
        $stock = $request->stock;
        $photo = $request->photo;
        $desc = $request->description;
        $category_id = $request->category_id;
        $stand = $request->stand;

        // $datetime = date("Y-m-d H:i:s");
        // $namafile = 'public/' .$name. $datetime;

        // move_uploaded_file($request->photo->pathname, "$namafile");

        $product = Product::find($id)->update([
            "name"=> $name,
            "price"=> $price,
            "stock"=> $stock,
            "photo"=> $photo,
            "desc"=> $desc,
            "category_id"=> $category_id,
            "stand"=> $stand
        ]);

        // return redirect()->back()->with("status", "Berhasil mengedit produk");
        return response()->json([
            'message' => 'Berhasil Mengedit Produk',
            'status' => 200,
            'data' => $product
        ]);
    }

    public function deleteProduct()
    {
        // Product::find($id)->delete();
        $products = Product::all();

        $product = "";

        return view('delete_product', compact('products', 'product'));

        // return redirect()->back()->with("status","Berhasil menghapus produk");
    }

    public function deleteProductCard(Request $request)
    {
        $products = Product::all();

        $product_id = $request->product_id;
        // dd($product_id);

        $product = Product::find($product_id);

        return view('delete_product', compact('product', 'products'));
    }

    public function destroy($id)
    {
        // $product_id = $request->product_id;

        $delete = Product::find($id)->delete();

        if ($delete)
        {
            // return redirect('/home')->with('status', 'Berhasil menghapus produk');
            return response()->json([
                'message'=>'Berhasil Menghapus Produk',
                'status'=>200,
            ]);
        }
        else
        {
            // return redirect('/home')->with('status','Gagal menghapus produk');
            return response()->json([
                'message'=>'Gagal Menghapus Produk',
                'status'=>400,
            ]);
        }
}
}