<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException; // Zaroori hai
use App\Models\ProductReview;

class ProductPageController extends Controller
{
    /**
     * Home page ke liye products fetch karein.
     */
    public function index() {
       
        $products = Product::withAvg('reviews', 'rating')
                           ->withCount('reviews')
                           ->where('status', 1) 
                           ->orderBy('created_at', 'desc')
                           ->paginate(12); 
                           
        return view('pages.home', compact('products'));
    }
    
    /**
     * Product Detail Page ke liye data load karein.
     */
 public function show($id) 
    {
        try {
           
            $product = Product::findOrFail($id); 
            
           
            $product->load([
                
                'images', 
                'colors', 
                'tags', 
                'reviews',
            ])
            ->loadAvg('reviews', 'rating')
            ->loadCount('reviews');

            // 3. View ko bhej dena
            return view('pages.product-detail', compact('product'));

        } catch (ModelNotFoundException $e) {
            
            abort(404, 'Product not found with ID: ' . $id);
        }
    }
    
}