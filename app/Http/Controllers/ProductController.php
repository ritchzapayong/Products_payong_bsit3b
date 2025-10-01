<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function productlist()
    {
        return view('productInfo');
    }

   
    public function productInfo()
    {
        return view('productInfo', [
            'id' => '101',
            'name' => 'Sample Product',
            'category' => 'Category A',
            'quantity' => 10,
            'price' => 500.00,
        ]);
    }

    
    public function productarray()
    {
        $data = [
            'products' => [
                ['id' => '101', 'name' => 'Sample Product', 'category' => 'Category A', 'quantity' => 10, 'price' => 500.00],
                ['id' => '102', 'name' => 'Another Product', 'category' => 'Category B', 'quantity' => 5,  'price' => 250.00],
                ['id' => '103', 'name' => 'Third Product',   'category' => 'Category C', 'quantity' => 15, 'price' => 150.00],
            ]
        ];
        return view('productInfo', $data);
    }

    
    public function prodWith()
    {
        $products = [
            ['id' => '101', 'name' => 'Sample Product', 'category' => 'Category A', 'quantity' => 10, 'price' => 500.00],
            ['id' => '102', 'name' => 'Another Product', 'category' => 'Category B', 'quantity' => 5,  'price' => 250.00],
            ['id' => '103', 'name' => 'Third Product',   'category' => 'Category C', 'quantity' => 15, 'price' => 150.00],
        ];
        return view('productInfo')->with('products', $products);
    }

    
    public function prodcompact()
    {
        $products = [
            ['id' => '101', 'name' => 'Sample Product', 'category' => 'Category A', 'quantity' => 10, 'price' => 500.00],
            ['id' => '102', 'name' => 'Another Product', 'category' => 'Category B', 'quantity' => 5,  'price' => 250.00],
            ['id' => '103', 'name' => 'Third Product',   'category' => 'Category C', 'quantity' => 15, 'price' => 150.00],
        ];
        return view('productInfo', compact('products'));
    }

    
    public function prodmasterlist(Request $request)
    {
        $products = $request->session()->get('products', []);
        return view('productInfo', compact('products'));
    }

    
    public function addproduct(Request $request)
    {
        $request->validate([
            'id'       => 'required',
            'name'     => 'required',
            'category' => 'required',
            'quantity' => 'required|numeric',
            'price'    => 'required|numeric',
        ]);

        $products = $request->session()->get('products', []);

        $products[] = [
            'id'       => $request->id,
            'name'     => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'price'    => $request->price,
        ];

        $request->session()->put('products', $products);

        return redirect()->route('products.masterlist');
    }

    
    public function editproduct(Request $request, $index)
    {
        $products = $request->session()->get('products', []);
        if (!isset($products[$index])) {
            return redirect()->route('products.masterlist')->with('error', 'Product not found.');
        }
        $product = $products[$index];
        return view('productInfoEdit', compact('product', 'index'));
    }

    
    public function updateproduct(Request $request, $index)
    {
        $products = $request->session()->get('products', []);
        if (isset($products[$index])) {
            $products[$index]['name']     = $request->name;
            $products[$index]['category'] = $request->category;
            $products[$index]['quantity'] = $request->quantity;
            $products[$index]['price']    = $request->price;
        }

        $request->session()->put('products', $products);

        return redirect()->route('products.masterlist');
    }


    public function deleteproduct(Request $request, $index)
    {
        $products = $request->session()->get('products', []);
        if (isset($products[$index])) {
            unset($products[$index]);
            $request->session()->put('products', array_values($products)); 
        }
        return redirect()->route('products.masterlist');
    }

   
    public function searchproduct(Request $request)
    {
        $keyword = strtolower($request->keyword);
        $products = $request->session()->get('products', []);

        $filtered = array_filter($products, function ($p) use ($keyword) {
            return strpos(strtolower($p['name']), $keyword) !== false;
        });

        return view('productInfo', ['products' => $filtered]);
    }
}