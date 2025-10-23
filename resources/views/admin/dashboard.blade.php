<x-app-layout>
    <style>
        /* ========== Global & Layout Fixes ========== */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main.dashboard-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f6fa;
            padding: 40px 0;
            font-family: 'Poppins', sans-serif;
            animation: pageFade 1.2s ease-in-out;
        }

        /* ========== Container & Titles ========== */
        .dashboard-container {
            width: 90%;
            max-width: 1200px;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2b2d42;
            margin-bottom: 35px;
            text-align: center;
            letter-spacing: 1px;
            animation: slideDown 0.9s ease-out;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* ========== Card & Header ========== */
        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeUp 1s ease-in-out;
            border: 1px solid #e0e4eb;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #4e73df 0%, #6890f5 100%);
            color: #fff;
            padding: 20px 28px;
            letter-spacing: 0.5px;
            border-bottom: none;
            position: relative;
            z-index: 2;
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* FIXED: Button Color Issue */
        .add-product-btn {
         
            background-color: #ffffff; /* Fixed: White Background */
            color: #4e73df; /* FIX APPLIED: Text color changed to blue for visibility */
            padding: 12px 25px; 
            border-radius: 50px;
            font-weight: 800; /* Bolder font */
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid #4e73df; /* Border for depth */
            
            /* High-End Transition */
            transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1.2); 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 1; /* Z-index for hover effect */
        }
        
        
        .add-product-btn .fas {
            transition: transform 0.5s ease-out;
        }

        
        .add-product-btn:hover {
            background-color: #4e73df; 
            color: #fff;
            transform: scale(1.05) translateY(-5px); 
            box-shadow: 0 15px 35px rgba(78, 115, 223, 0.5); 
            border-color: #fff;
        }

       
        .add-product-btn:active {
            transform: scale(0.98) translateY(0); /* Press down */
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

       
        .add-product-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 50%; 
            height: 100%;
            background: rgba(255, 255, 255, 0.4);
            transform: skewX(-30deg); 
            transition: left 0.8s cubic-bezier(0.2, 0.8, 0.2, 1.2);
            z-index: 0;
        }

        
        .add-product-btn:hover::before {
            left: 150%;
        }

       
        .add-product-btn i.fa-plus {
            font-size: 1.2em;
            transition: transform 0.5s ease-out, opacity 0.3s;
        }

       
        .add-product-btn:hover i.fa-plus {
            transform: rotate(135deg); 
        }
        
        /* ========== Table Styling ========== */
        .card-body {
            padding: 30px;
            animation: fadeIn 1.1s ease;
        }
        
        .table-responsive {
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            color: #333;
            font-size: 0.9rem;
            min-width: 900px; /* Responsive fix for small screens */
        }

        .custom-table thead {
            background-color: #f0f5ff;
        }

        .custom-table th,
        .custom-table td {
            padding: 15px 18px;
            text-align: left;
            vertical-align: middle;
            white-space: nowrap; /* Prevent wrapping in cells */
        }

        .custom-table th {
            font-weight: 600;
            color: #4e73df;
            text-transform: uppercase;
            font-size: 0.85rem;
            border-bottom: 2px solid #ddd;
        }

        .custom-table tbody tr {
            border-bottom: 1px solid #e4e6eb;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .custom-table tbody tr:hover {
            background-color: #f9fbfd;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        /* Image Column */
        .product-image {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            border: 2px solid #fff;
            transition: transform 0.4s ease;
        }
        
        .custom-table tbody tr:hover .product-image {
            transform: scale(1.05);
        }

        /* Status Badges */
        .status-badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-block;
            letter-spacing: 0.5px;
            animation: pulse 2s infinite ease-in-out;
        }

        .status-active {
            background-color: #2ecc7133;
            color: #27ae60;
        }

        .status-inactive {
            background-color: #e74c3c33;
            color: #c0392b;
            animation: none; /* Inactive should not pulse */
        }

        /* Action Buttons */
        .action-btn {
            color: #4e73df;
            margin: 0 7px;
            font-size: 1.2rem;
            transition: color 0.3s ease, transform 0.3s ease, filter 0.3s ease;
        }

        .action-btn:hover {
            color: #2e59d9;
            transform: scale(1.3) rotate(5deg);
        }

        .action-btn.delete-btn {
            color: #e74a3b;
        }

        .action-btn.delete-btn:hover {
            color: #c0392b;
            filter: drop-shadow(0 0 5px rgba(192, 57, 43, 0.5));
        }
        
        /* Pagination Styling */
        .pagination-links {
            padding: 25px 0 10px;
            display: flex;
            justify-content: center;
        }
        
        /* Keyframe Animations */
        @keyframes slideDown {
            0% { opacity: 0; transform: translateY(-50px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes pageFade {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(46, 204, 113, 0); }
            100% { box-shadow: 0 0 0 0 rgba(46, 204, 113, 0); }
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJdZtO5eNkyLRLC1pA7I7T7Y/5K/z3fI9yL/jFp+3n/j2xJjY5O9q+M9T5Pqg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <main class="dashboard-section">
        <section class="dashboard-container">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            
          
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 w-full" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Products</h4>
                  
                    <a href="{{ route('product.create') }}" class="add-product-btn">
                         <i class="fas fa-plus"></i>
                         Add New Product
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                                            @else
                                                <i class="fas fa-box-open text-gray-400 text-2xl"></i>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($product->name, 30) }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if($product->status == 1)
                                                <span class="status-badge status-active">Active</span>
                                            @else
                                                <span class="status-badge status-inactive">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            
                                            <a href="{{ route('product.edit', $product->id) }}" class="action-btn" title="Edit Product">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                          
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn delete-btn" title="Delete Product">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-gray-500">
                                            <i class="fas fa-exclamation-circle mr-2"></i> No products found. Click "Add New Product" to get started!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                  
                    @if($products->hasPages())
                        <div class="pagination-links">
                            {{ $products->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </section>
    </main>
</x-app-layout>
