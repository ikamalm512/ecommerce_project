<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product; 
use App\Models\ProductColor;
use App\Models\ProductImage; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $products = Product::latest()->paginate(10); 
        
       
        return view('admin.dashboard', compact('products'));
    }


    /**
   
     */
    public function create()
    {
        
     $commonColorCodes = [
            'red' => '#E74C3C',        
            'blue' => '#3498DB',       
            'black' => '#000000',      
            'green' => '#2ECC71',      
            'white' => '#FFFFFF',      
            'yellow' => '#F1C40F',     
        ];
        
      
        $colors = array_keys($commonColorCodes); 

       return view('admin.product.create', compact('colors'));
    }

    /**
     * 
     */

    
    public function store(Request $request)
    {
        $commonColorCodes = [
            'red' => '#E74C3C', 'blue' => '#3498DB', 'black' => '#000000',
            'green' => '#2ECC71', 'white' => '#FFFFFF', 'yellow' => '#F1C40F',
        ];

        DB::beginTransaction();
        
        $featuredImagePath = null; 
        $galleryImagePaths = []; 

        try {
            
            $validatedData = $request->all(); 
            
            
            $processedTags = null;
            if ($request->filled('tags')) {
                $tagsArray = explode(',', $request->tags);
                $cleanTags = array_map(fn($tag) => strtolower(trim($tag)), $tagsArray);
                $uniqueTags = array_unique(array_filter($cleanTags));
                $processedTags = json_encode($uniqueTags);
            }
            
          
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $fileName = time() . '.' . $request->image->extension();
              
                $featuredImagePath = $request->image->storeAs('images/products', $fileName, 'public');
            }
            
           
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                        $path = $file->storeAs('images/gallery', $fileName, 'public');
                        
                        $galleryImagePaths[] = $path; 
                    }
                }
            }

           
            $product = new Product();
            $product->name = $validatedData['name'];
            $product->price = $validatedData['price'];
            $product->short_description = $validatedData['short_description'] ?? null;
            $product->description = $validatedData['description'] ?? null;
            $product->quantity = $validatedData['quantity'];
            $product->sku = $validatedData['sku'];
            $product->status = $validatedData['status'];
            
           
            $product->image = $featuredImagePath; 
            $product->tags = $processedTags; 

            $product->save(); 

         
            if (!empty($validatedData['colors'])) {
                $colorRecords = [];
                foreach ($validatedData['colors'] as $colorName) {
                    $hexCode = $commonColorCodes[$colorName] ?? null;
                    $colorRecords[] = [
                        'product_id' => $product->id, 
                        'color_name' => $colorName,
                        'created_at' => now(), 'updated_at' => now(), 'color_code' => $hexCode,
                    ];
                }
                ProductColor::insert($colorRecords);
            }
            
        
            if (!empty($galleryImagePaths)) {
                $imageRecords = [];
                foreach ($galleryImagePaths as $path) {
                    $imageRecords[] = [
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'created_at' => now(), 'updated_at' => now(),
                    ];
                }
                ProductImage::insert($imageRecords);
            }


            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Product saved successfully!');

        } catch (\Exception $e) {

         
            DB::rollback();
            
            if ($featuredImagePath) {
                Storage::disk('public')->delete($featuredImagePath);
            }
            foreach ($galleryImagePaths as $path) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()->withInput()->with('error', 'FATAL ERROR (Debug): ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
 public function edit(string $id)
{
   
    $product = Product::with(['colors', 'images'])->findOrFail($id);

   
    $allColors = ['red', 'blue', 'black', 'green', 'white', 'yellow']; 

    
    $selectedColors = $product->colors->pluck('color_name')->toArray();


    return view('admin.product.edit', compact('product', 'allColors', 'selectedColors'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductStoreRequest $request, string $id) 
    {
       
        $validatedData = $request->validated(); 
        
        $product = Product::findOrFail($id);

     
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($validatedData['image']); 
        }

      
        $product->update($validatedData); 

       
        $product->colors()->delete(); 

        if ($request->filled('colors')) {
            $productColors = [];
            foreach ($request->colors as $color) {
                $productColors[] = ['product_id' => $product->id, 'color_name' => $color];
            }
            ProductColor::insert($productColors);
        }

       
        if ($request->hasFile('images')) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
            foreach ($request->file('images') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create(['image_path' => $path]); 
            }
        }
        
        return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $product = Product::findOrFail($id);
         
       
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

       
       
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

       
        $product->delete();

       
        return redirect()->route('dashboard')->with('success', 'Product deleted successfully!');
    }
    
}
