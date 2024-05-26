<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//Jobs
use App\Jobs\ProductCreated;

// Models
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response($products, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->only('product_name','product_stock'));
        ProductCreated::dispatch($product->toArray())->onQueue('default');
        return response($product, Response::HTTP_OK);
    }
}
