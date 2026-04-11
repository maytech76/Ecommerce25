<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Product;


class HomeController extends Controller
{
 
    public function index(Request $request){
        
        $categories = Category::all();
        
        $topSellingProducts = Product::with(['category', 'brand', 'reviews'])
            ->where('status', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(12)
            ->get();
        
        return view('welcome', compact('categories', 'topSellingProducts'));
    }
}
