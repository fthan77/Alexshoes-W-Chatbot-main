<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\About;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $about = About::first();
        $products = Product::latest()->take(6)->get();
        $testimonials = Testimonial::latest()->take(6)->get();
        return view('home', compact('about', 'products', 'testimonials'));
    }

    public function show(Product $product)
    {
        $about = About::first();
        return view('products.show', compact('product', 'about'));
    }
}
