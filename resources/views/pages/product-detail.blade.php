<x-app-layout>
    <style>
        /* 🌈 GLOBAL BACKGROUND ANIMATION (Listing page jaisa) */
        body {
            font-family: 'Poppins', sans-serif;
            /* Yahi gradient aap ne dusre pages mein use kiya tha */
            background: linear-gradient(-45deg, #e0e7ff, #c7d2fe, #a5b4fc, #818cf8);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* 🌟 MAIN CONTAINER STYLE */
        main {
            padding: 60px 0;
            min-height: 100vh;
        }

        /* 🧊 DETAIL CARD CONTAINER (Glass Effect) */
        .detail-card-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            /* Glassmorphism Effect */
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(18px);
            border-radius: 25px;
            border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 25px 70px rgba(79,70,229,0.25);
            padding: 30px;
            /* Animation effect */
            opacity: 0;
            animation: fadeInScale 0.8s ease-out forwards;
        }
        @keyframes fadeInScale {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }

        @media (min-width: 1024px) {
            .detail-card-container {
                padding: 50px;
            }
        }

        /* 🖼️ MAIN IMAGE STYLE */
        .main-image-wrapper {
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: #ffffff99; /* Light background for glass effect */
            transition: transform 0.5s ease;
        }
        .main-image-wrapper:hover {
            transform: scale(1.01);
        }

        .main-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* 🖼️ THUMBNAIL GALLERY */
        .thumbnail-gallery img {
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
            opacity: 0.8;
        }
        .thumbnail-gallery img:hover {
            border-color: #4f46e5;
            opacity: 1;
        }

        /* ℹ️ PRODUCT INFO STYLING */
        .product-name {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1e1b4b;
            line-height: 1.2;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 2.5rem;
            font-weight: 900;
            color: #4338ca; /* Primary Accent Color */
            margin-top: 10px;
            text-shadow: 0 4px 10px rgba(67, 56, 202, 0.2);
        }

        /* ⭐ RATING STYLES */
        .star-icon {
            color: #facc15; /* Yellow/Amber color */
            margin-right: 2px;
        }
        .review-link {
            color: #4f46e5;
            font-weight: 600;
            transition: color 0.3s;
        }
        .review-link:hover {
            color: #312e81;
        }

        /* 🛒 ADD TO CART BUTTON */
        .add-to-cart-btn {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            box-shadow: 0 12px 25px rgba(67, 56, 202, 0.4);
            transition: all 0.4s ease;
            border-radius: 14px;
        }
        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, #4338ca, #312e81);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(67, 56, 202, 0.6);
        }

        /* 📜 DESCRIPTION & REVIEWS SECTION */
        .details-section {
            background: rgba(255, 255, 255, 0.4); /* Thoda halka glass effect */
            border-radius: 18px;
            padding: 30px;
            margin-top: 30px;
            border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .details-section h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e1b4b;
            border-bottom: 3px solid #4338ca;
            padding-bottom: 8px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJdZtO5eNkyLRLC1pA7I7T7Y/5K/z3fI9yL/jFp+3n/j2xJjY5O9q+M9T5Pqg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <main>
        <div class="detail-card-container">
            
            {{-- Product Detail: Main Section (Left: Images, Right: Info) --}}
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">
                
                {{-- LEFT SIDE: Images --}}
                <div class="flex flex-col-reverse">
                    
                    {{-- Main Product Image (Single Image) --}}
                    <div class="main-image-wrapper w-full aspect-w-1 aspect-h-1 mb-6">
                        @php
                            // ✅ Safety Fix: Use optional() to safely handle potentially missing relationships/properties
                            $images = optional($product)->images;
                            $firstImage = optional($images)->first(); 
                            // Check for first gallery image, then for featured image on product model
                            $mainImage = optional($firstImage)->image_path ?? optional($product)->image ?? 'images/default.jpg';
                            
                            $reviewsCount = $product->reviews_count ?? 0;
                            $avgRating = $product->reviews_avg_rating ?? 0;
                        @endphp
                        <img 
                            src="{{ asset('storage/' . $mainImage) }}" 
                            alt="{{ optional($product)->name ?? 'Product' }}" 
                            class="w-full h-full object-center object-cover"
                        >
                    </div>

                    {{-- Small Images Gallery (Multiple Images) --}}
                    {{-- ✅ Safety Fix: Check if images relationship exists and has items --}}
                    @if(optional($images)->count() > 1)
                        <div class="thumbnail-gallery mt-2 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                            <div class="grid grid-cols-4 gap-4">
                                @foreach ($images as $image)
                                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                                        <img 
                                            src="{{ asset('storage/' . $image->image_path) }}" 
                                            alt="Product Thumbnail" 
                                            class="w-full h-full object-center object-cover"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT SIDE: Product Info --}}
                <div class="mt-10 lg:mt-0">
                    
                    {{-- Product Name --}}
                    <h1 class="product-name">{{ $product->name }}</h1>

                    {{-- Price --}}
                    <p class="product-price">${{ number_format($product->price, 2) }}</p>
                    
                    {{-- Rating & Reviews --}}
                    <div class="mt-4 flex items-center">
                        @if($reviewsCount > 0)
                            <div class="flex items-center">
                                {{-- Star Rating Display --}}
                                @for ($i = 1; $i <= 5; $i++)
                                    {{-- reviews_avg_rating use ho raha hai --}}
                                    <i class="fa-{{ $i <= round($avgRating) ? 'solid' : 'regular' }} fa-star star-icon"></i>
                                @endfor
                            </div>
                            <a href="#reviews-section" class="ml-3 text-sm review-link">
                                {{ $reviewsCount }} reviews
                            </a>
                        @else
                            <span class="text-sm text-gray-500">Be the first to review!</span>
                        @endif
                    </div>
                    
                    <hr class="my-6 border-indigo-200/50">

                    {{-- Short Description --}}
                    <div class="mt-6">
                        <p class="text-base text-gray-700 leading-relaxed">{{ $product->short_description }}</p>
                    </div>
                    
                    {{-- SKU and Status --}}
                    <div class="mt-6 space-y-2 text-sm">
                        <p class="text-gray-600">
                            <strong>SKU:</strong> <span class="font-medium text-gray-800">{{ $product->sku }}</span>
                        </p>
                        <p class="font-semibold {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->quantity > 0 ? 'In Stock (' . $product->quantity . ' items)' : 'Out of Stock' }}
                        </p>
                    </div>

                    {{-- Add to Cart Form --}}
                    <form class="mt-8">
                        <button type="submit" 
                            class="add-to-cart-btn w-full py-3 px-8 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-indigo-500"
                            {{ $product->quantity <= 0 ? 'disabled' : '' }}
                        >
                            <i class="fas fa-shopping-cart mr-2"></i> 
                            {{ $product->quantity <= 0 ? 'Out of Stock' : 'Add to Cart' }}
                        </button>
                    </form>

                </div>
            </div>

            {{-- Product Long Description --}}
            <div class="details-section mt-12">
                <h2>Product Details</h2>
                <div class="mt-4 prose max-w-none text-gray-700 leading-relaxed">
                    <p>{!! nl2br(e($product->description)) !!}</p>
                </div>
            </div>
            
            {{-- Reviews Section --}}
            <div id="reviews-section" class="details-section mt-8">
                <h2>Customer Reviews ({{ $reviewsCount }})</h2>
                
               
                @if($reviewsCount > 0 && optional($product)->reviews)
                    @foreach ($product->reviews as $review)
                        <div class="mt-6 p-4 border-b border-indigo-200/50 last:border-b-0">
                            <div class="flex items-center mb-1">
                                {{-- Rating Stars for individual review --}}
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star text-sm star-icon"></i>
                                @endfor
                                <span class="ml-3 text-sm font-medium text-gray-900">
                                    {{ $review->rating }}/5
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-gray-600">Reviewed by: <strong>{{ $review->user_name ?? 'Anonymous User' }}</strong></p> 
                            <p class="mt-2 text-base text-gray-800 leading-normal">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="mt-4 text-gray-600">Is product ke liye abhi koi review nahi hai.</p>
                @endif
            </div>

        </div>
    </main>
</x-app-layout>