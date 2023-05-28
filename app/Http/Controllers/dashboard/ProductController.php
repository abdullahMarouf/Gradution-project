<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->paginate();
        return response()->view('dashboard.products.index' ,compact('products'));
    }

//    public function addToCart($id)
//    {
//        $product = Product::findOrFail($id);
//        {
//            $product = Product::findOrFail($id);
//
//            $cart = session()->get('cart', []);
//
//            if(isset($cart[$id])) {
//                $cart[$id]['quantity']++;
//            }  else {
//                $cart[$id] = [
//                    "name" => $product->name,
//                    "image" => $product->image,
//                    "price" => $product->price,
//                    "quantity" => 1
//                ];
//            }
//
//            session()->put('cart', $cart);
//            return redirect()->back()->with('success', 'Product add to cart successfully!');
//        }
//    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = Product::all();
        return response()->view('dashboard.products.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => [
                'required', 'string', 'min:3', 'max:255',
            ],
            'description' => [
                'required', 'string', 'min:10', 'max:500'
            ],
            'price' => [
                'required','numeric','min:0'
            ],
            // 'image' => [
            //     'mimes:png,jpg', 'max:3025'
            // ],
            'status' => 'in:active,draft,archived',
        ]);
        $product= new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public',
            ]);
            $data['image'] = $path;
        $product->image =$data['image'];
        }
        $product->status = $request->input('status');
        $product->save();
        return redirect()->route('products.index')->with('success', 'product created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('dashboard.products.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = product::findOrFail($id);
        return response()->view('dashboard.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => [
                'nullable', 'string', 'min:3', 'max:255'
            ],
            'price' => [
                'nullable','numeric','min:0'
            ],
            'price' => [
                'nullable','numeric','min:0'
            ],
            'description' => [
                'nullable', 'string', 'min:10', 'max:500'
            ],
            'status' => 'nullable|in:active,draft,archived',
        ]);

        $product = product::findOrFail($id);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->status = $request->input('status');
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product=Product::findOrFail($id);
        $product->delete();
         return redirect()->back()->with('success', 'Product Deleted!');
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->paginate();
        return response()->view('dashboard.products.trash', ['products' => $products]);
    }
    public function restore($id)
    {
        $Product = Product::onlyTrashed()->findOrFail($id);
        $Product->restore();
        return redirect()->route('products.index');
    }
    public function forceDelete($id)
    {
        $Product = Product::onlyTrashed()->findOrFail($id);
        $Product->forceDelete();
        if ($Product->image) {
            Storage::disk('public')->delete($Product->image);
        }
        return redirect()->route('products.trash');
    }
}
