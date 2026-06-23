<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $banners      = Banner::active()->hero()->orderBy('sort_order')->get();
        $categories   = Category::active()->parent()->with('children')->take(8)->get();
        $featured     = Product::active()->featured()->with('category')->take(8)->get();
        $newArrivals  = Product::active()->newArrivals()->with('category')->take(8)->get();
        $bestSelling  = Product::active()->bestSelling()->with('category')->take(8)->get();
        $discounts    = Product::active()->whereNotNull('sale_price')->with('category')->take(8)->get();

        return view('frontend.home.index', compact('banners', 'categories', 'featured', 'newArrivals', 'bestSelling', 'discounts'));
    }
}
