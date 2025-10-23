<x-app-layout>
    <style>
        /* CSS is copied from your last provided block to ensure continuity */
        /* 🌈 GLOBAL BACKGROUND ANIMATION (The beautiful gradient from your previous design) */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #e0e7ff, #c7d2fe, #a5b4fc, #818cf8);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* 🌟 MAIN LAYOUT */
        main {
            padding: 60px 0;
            flex-grow: 1; 
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        /* 🧊 DETAIL CARD CONTAINER (Enhanced Glassmorphism) */
        .detail-card-container {
            width: 95%;
            max-width: 1280px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(25px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 40px 90px rgba(79, 70, 229, 0.35);
            padding: 40px;
            opacity: 0;
            animation: fadeInScale 0.9s ease-out forwards;
        }
        @keyframes fadeInScale {
            0% { opacity: 0; transform: scale(0.98); }
            100% { opacity: 1; transform: scale(1); }
        }

        /* 🖼️ IMAGE WRAPPER */
        .main-image-wrapper {
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.2);
            transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .main-image-wrapper:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        /* 🖼️ THUMBNAIL GALLERY */
        .thumbnail-gallery img {
            border-radius: 12px;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
            opacity: 0.9;
        }
        .thumbnail-gallery img.active-thumb,
        .thumbnail-gallery img:hover {
            border-color: #4f46e5;
            opacity: 1;
            transform: scale(1.05);
        }
        
        /* ℹ️ PRODUCT INFO STYLING (Same attractive styling maintained) */
        .product-name {
            font-size: 3rem;
            font-weight: 900;
            color: #1e1b4b;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.05);
        }
        .product-price {
            font-size: 3.2rem;
            font-weight: 900;
            color: #312e81;
            margin-top: 5px;
            text-shadow: 0 5px 15px rgba(67, 56, 202, 0.3);
        }
        .star-icon { color: #fbbf24; }
        .review-link { color: #4f46e5; font-weight: 600; }
        .add-to-cart-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #312e81 100%);
            box-shadow: 0 15px 35px rgba(67, 56, 202, 0.5);
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1.2);
            border-radius: 18px;
            font-size: 1.1rem;
        }
        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, #312e81, #1e1b4b);
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(67, 56, 202, 0.7);
        }

        /* 📜 DETAILS SECTION */
        .details-section {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            padding: 35px;
            margin-top: 40px;
            border: 1px solid rgba(255,255,255,0.6);
        }
        .details-section h2 {
            font-size: 2rem;
            font-weight: 900;
            color: #1e1b4b;
            border-bottom: 4px solid #4f46e5;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        
        .review-box {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
    </style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJdZtO5eNkyLRLC1pA7I7T7Y/5K/z3fI9yL/jFp+3n/j2xJjY5O9q+M9T5Pqg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <main>
        <div class="detail-card-container">
            
            {{-- Product Detail: Main Section (Left: Images, Right: Info & Reviews) --}}
            <div class="lg:grid lg:grid-cols-3 lg:gap-x-12 lg:items-start">
                
                {{-- COLUMN 1 (40% Width): Images (Left Side) --}}
                <div class="lg:col-span-1 flex flex-col-reverse">
                    
                    @php
                        // Default Image (Single image) for main display
                        $defaultImagePath = $product->image ?? 'images/default.jpg';
                        $galleryImages = optional($product)->images ?? collect();
                        $reviewsCount = $product->reviews_count ?? 0;
                        $avgRating = $product->reviews_avg_rating ?? 0;
                    @endphp

                    {{-- Main Product Image Display Area --}}
                    <div class="main-image-wrapper w-full aspect-square mb-6">
                        <img 
                            id="main-product-display"
                            src="{{ asset('storage/' . $defaultImagePath) }}" 
                            alt="{{ optional($product)->name ?? 'Product' }}" 
                            class="w-full h-full object-center object-cover rounded-2xl"
                        >
                    </div>

                    {{-- Small Images Gallery (Thumbnails) --}}
                    @if($galleryImages->isNotEmpty() || $defaultImagePath)
                        <div class="thumbnail-gallery mb-4 w-full mx-auto sm:block lg:max-w-none">
                            <div class="grid grid-cols-4 gap-4">
                                
                                {{-- 1. Default/Single Featured Image Thumbnail --}}
                                <div class="aspect-square rounded-xl overflow-hidden shadow-md">
                                    <img 
                                        src="{{ asset('storage/' . $defaultImagePath) }}" 
                                        alt="Featured Image" 
                                        data-full-src="{{ asset('storage/' . $defaultImagePath) }}"
                                        class="w-full h-full object-center object-cover thumbnail active-thumb"
                                        onclick="changeMainImage(this)"
                                    >
                                </div>
                                
                                {{-- 2. Multiple Gallery Images Thumbnails --}}
                                @foreach ($galleryImages->take(3) as $image)
                                    <div class="aspect-square rounded-xl overflow-hidden shadow-md">
                                        <img 
                                            src="{{ asset('storage/' . $image->image_path) }}" 
                                            alt="Gallery Thumbnail" 
                                            data-full-src="{{ asset('storage/' . $image->image_path) }}"
                                            class="w-full h-full object-center object-cover thumbnail"
                                            onclick="changeMainImage(this)"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- COLUMN 2 & 3 (60% Width): Product Info, Reviews, and Buy Section (Right Side) --}}
                <div class="lg:col-span-2 mt-10 lg:mt-0">
                    
                    {{-- Product Name and Price Block (Fixed at Top Right) --}}
                    <div class="pb-6 border-b border-indigo-200/50">
                        <h1 class="product-name">{{ $product->name }}</h1>
                        <p class="product-price">${{ number_format($product->price, 2) }}</p>
                    </div>
                    
                    {{-- Reviews Summary Block (Placed right after Price, as requested) --}}
                    <div class="mt-6 p-4 bg-white/60 rounded-xl shadow-lg border border-indigo-200/50">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Customer Rating</h3>
                        @if($reviewsCount > 0)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-2xl">
                                    {{-- Star Rating Display --}}
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-{{ $i <= round($avgRating) ? 'solid' : 'regular' }} fa-star star-icon"></i>
                                    @endfor
                                </div>
                                <span class="text-3xl font-extrabold text-gray-800">{{ number_format($avgRating, 1) }} / 5</span>
                            </div>
                            <a href="#reviews-section" class="mt-3 block text-sm review-link hover:underline text-right">
                                Read all {{ $reviewsCount }} reviews
                            </a>
                        @else
                            <p class="text-base text-gray-600">Be the first to review this product!</p>
                        @endif
                    </div>
                    
                    {{-- Short Description --}}
                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 border-b border-indigo-200/50 pb-2">Highlights</h3>
                        <p class="text-lg text-gray-800 leading-relaxed font-medium">{{ $product->short_description }}</p>
                    </div>

                    {{-- SKU and Status --}}
                    <div class="mt-8 space-y-3 text-base">
                        <p class="text-gray-700">
                            <strong>SKU:</strong> <span class="font-bold text-gray-900">{{ $product->sku }}</span>
                        </p>
                        <p class="font-bold {{ $product->quantity > 0 ? 'text-green-700' : 'text-red-700' }}">
                            <i class="fas fa-box-open mr-2"></i>
                            {{ $product->quantity > 0 ? 'In Stock (' . $product->quantity . ' items)' : 'Out of Stock' }}
                        </p>
                    </div>
                    
                    {{-- Add to Cart Form --}}
                    <form class="mt-10">
                        <button type="submit" 
                            class="add-to-cart-btn w-full py-4 px-8 font-extrabold text-white uppercase tracking-wider focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-offset-white focus:ring-indigo-600"
                            {{ $product->quantity <= 0 ? 'disabled' : '' }}
                        >
                            <i class="fas fa-shopping-bag mr-3 text-lg"></i> 
                            {{ $product->quantity <= 0 ? 'Temporarily Unavailable' : 'Add to Cart' }}
                        </button>
                    </form>

                </div>
            </div> {{-- End of Main Grid (Image and Info) --}}


            {{-- BOTTOM SECTION: Full Description and All Reviews --}}
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 mt-12">
                
                {{-- COLUMN 1: Product Long Description (Bottom Left) --}}
                <div class="details-section">
                    <h2>Full Product Description</h2>
                    <div class="mt-4 prose max-w-none text-gray-800 leading-relaxed">
                        {{-- Use {!! $product->description !!} if it contains HTML (from TinyMCE/CKEditor) --}}
                        <p>{!! $product->description !!}</p>
                    </div>
                </div>
                
                {{-- COLUMN 2: Full Reviews List (Bottom Right) --}}
                <div id="reviews-section" class="details-section mt-8 lg:mt-0">
                    <h2>All Customer Reviews</h2>
                    
                    @if($reviewsCount > 0 && optional($product)->reviews)
                        @foreach ($product->reviews as $review)
                            <div class="review-box mt-4">
                                <div class="flex items-center mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star text-base star-icon"></i>
                                    @endfor
                                    <span class="ml-3 text-base font-bold text-gray-900">{{ $review->rating }}/5</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600">Reviewed by: <strong class="text-gray-800">{{ $review->user_name ?? 'Anonymous User' }}</strong></p> 
                                <p class="mt-3 text-lg text-gray-800 leading-snug">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="mt-4 text-gray-600 font-medium">No reviews yet. Share your thoughts!</p>
                    @endif
                </div>
            </div>

        </div> {{-- End of detail-card-container --}}
    </main>
    
    <script>
        function changeMainImage(thumbnail) {
            const mainImageEl = document.getElementById('main-product-display');
            const newSrc = thumbnail.getAttribute('data-full-src');
            
            // Change main image
            mainImageEl.src = newSrc;

            // Update active thumbnail border
            document.querySelectorAll('.thumbnail').forEach(img => {
                img.classList.remove('active-thumb');
            });
            thumbnail.classList.add('active-thumb');
        }
    </script>
    
    {{-- FOOTER FIX: Footer ko yahaan include karein agar woh 'layouts.footer' mein hai --}}
    {{-- @include('layouts.footer') --}}

</x-app-layout>