<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\ProductPageController; 
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductPageController::class, 'index'])->name('home'); 

Route::get('/product/{id}', [ProductPageController::class, 'show'])->name('product.show');

// Route::get('/test', function () {
    
    //   $commonColorCodes = [
    //         'red' => '#E74C3C',        
    //         'blue' => '#3498DB',       
    //         'black' => '#000000',      
    //         'green' => '#2ECC71',      
    //         'white' => '#FFFFFF',      
    //         'yellow' => '#F1C40F',     
    //     ];
        
      
    //     $colors = array_keys($commonColorCodes); 

       
    //     return view('admin.product.create', compact('colors'));

  

// });


Route::get('/play', [ProductController::class, 'create']);


Route::middleware('auth')->group(function () {
  
    Route::get('/dashboard', [ProductController::class, 'index']) 
        ->middleware(['verified'])
        ->name('dashboard');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('product', ProductController::class); 

   
});

require __DIR__.'/auth.php';