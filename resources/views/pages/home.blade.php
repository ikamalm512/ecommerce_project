<x-app-layout>
<style>
/* 🌈 GLOBAL BACKGROUND ANIMATION */
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

/* 🌟 PAGE LAYOUT */
main {
    padding: 60px 0;
    min-height: 100vh;
}

.product-section {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.product-section h2 {
    font-size: 2.3rem;
    font-weight: 800;
    color: #1e1b4b;
    margin-bottom: 50px;
}

/* 🧊 PRODUCT GRID */
.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 💎 3 Cards Per Row */
    gap: 35px; /* 💫 Perfect spacing between cards */
    justify-items: center;
}

/* 🔁 Responsive Breakpoints */
@media (max-width: 1024px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 700px) {
    .product-grid {
        grid-template-columns: 1fr;
    }
}

/* 🧃 PRODUCT CARD */
.product-card {
    position: relative;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(18px);
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.4);
    box-shadow: 0 20px 55px rgba(79,70,229,0.25);
    transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    width: 100%;
    max-width: 340px; /* 🎯 Fixed balanced width */
}
.product-card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 30px 80px rgba(79,70,229,0.35);
}

/* 🖼️ IMAGE */
.product-image {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
}
.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease, filter 0.4s ease;
}
.product-card:hover .product-image img {
    transform: scale(1.05);
    filter: brightness(1.1);
}

/* 🎀 RIBBON */
.product-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: linear-gradient(135deg, #ef4444, #b91c1c);
    color: white;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 6px;
    box-shadow: 0 4px 10px rgba(239,68,68,0.4);
    z-index: 10;
}

/* 🧾 INFO */
.product-info {
    padding: 25px 20px 35px 20px;
    text-align: center;
    color: #111827;
}

/* 🛍️ NAME */
.product-name {
    font-size: 1.2rem;
    font-weight: 800;
    margin-bottom: 10px;
    color: #1e1b4b;
    transition: color 0.3s ease, text-shadow 0.3s ease;
}
.product-name:hover {
    color: #4338ca;
    text-shadow: 0 2px 10px rgba(67,56,202,0.3);
}

/* ⭐ RATING */
.product-rating i {
    color: #facc15;
    transition: transform 0.3s ease, color 0.3s ease;
}
.product-rating i:hover {
    transform: scale(1.2);
    color: #fde047;
}
.product-rating span {
    margin-left: 6px;
    color: #6b7280;
    font-size: 0.8rem;
}

/* 💰 PRICE */
.product-price {
    font-size: 1.8rem;
    font-weight: 900;
    color: #0f42e9ff;
    margin: 1rem 0;
    text-shadow: 0 4px 14px rgba(79,70,229,0.35);
}

/* 🛒 BUTTON */
.add-to-cart {
    background: linear-gradient(135deg, #6366f1, #046adfff);
    border: none;
    border-radius: 14px;
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    padding: 12px 0;
    width: 80%;
    box-shadow: 0 10px 22px rgba(8, 97, 214, 0.4);
    transition: all 0.4s ease;
    cursor: pointer;
}
.add-to-cart:hover {
    background: linear-gradient(135deg, #0764cfff, #312e81);
    transform: translateY(-5px);
    box-shadow: 0 20px 30px rgba(4, 7, 185, 0.6);
}

.pagination-links {
    margin-top: 60px;
    display: flex;
    justify-content: center;
    gap: 10px;
}
.pagination-links a,
.pagination-links span {
    min-width: 44px;
    height: 44px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #d1d5db;
    background: rgba(255,255,255,0.5);
    color: #4338ca;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 3px 12px rgba(0,0,0,0.05);
    backdrop-filter: blur(10px);
}
.pagination-links a:hover {
    background: #4338ca;
    color: white;
    transform: translateY(-2px);
}
.pagination-links span[aria-current="page"] {
    background: linear-gradient(135deg, #6366f1, #4338ca);
    color: white;
    border-color: transparent;
    font-weight: 800;
    box-shadow: 0 6px 18px rgba(79,70,229,0.4);
}
</style>

<main>
    <section class="product-section">
        <h2>Featured Collection</h2>

        <div class="product-grid">
            @forelse ($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        {{-- ✅ FIX: Anchor tag ko image aur fallback div ke around wrap kiya gaya --}}
                        <a href="{{ route('product.show', $product->id) }}"> 
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div style="background:#eef2ff; height:100%; display:flex; justify-content:center; align-items:center;">
                                    <i class="fa-solid fa-box-open" style="font-size:60px; color:#6366f1;"></i>
                                </div>
                            @endif
                        </a> {{-- ✅ FIX: Yahan band ho raha hai --}}
                        <span class="product-badge">NEW</span>
                    </div>

                    <div class="product-info">
                        {{-- Product Name ka link --}}
                        <a href="{{ route('product.show', $product->id) }}">
                            <h3 class="product-name">{{ $product->name }}</h3>
                        </a>

                        <div class="product-rating">
                            @php
                                // ✅ Safety Fix: Optional helper is used to ensure no fatal error if aggregate properties are somehow missing.
                                $averageRating = optional($product)->reviews_avg_rating ?? 0;
                                $reviewCount = optional($product)->reviews_count ?? 0;
                                $roundedRating = round($averageRating);
                            @endphp

                            @if ($reviewCount > 0)
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $roundedRating ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                                <span>({{ $reviewCount }})</span>
                            @else
                                <span style="color:#9ca3af; font-style:italic;">No ratings yet</span>
                            @endif
                        </div>

                        <p class="product-price">${{ number_format($product->price, 2) }}</p>

                        <button class="add-to-cart">
                            <i class="fas fa-shopping-cart" style="margin-right:6px;"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; background:white; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.05); padding:50px 0;">
                    <i class="fas fa-box-open" style="font-size:70px; color:#9ca3af; margin-bottom:20px;"></i>
                    <p style="font-size:1.5rem; color:#4b5563; font-weight:600;">No products are currently available.</p>
                    <p style="color:#6b7280;">New products will be added soon.</p>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="pagination-links">
                {{ $products->links() }}
            </div>
        @endif
    </section>
</main>
</x-app-layout>

