<x-app-layout>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6fa;
        }

        main.dashboard-section {
            flex: 1;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: column;
            padding: 40px 0;
        }

        .dashboard-container {
            width: 90%;
            max-width: 900px;
        }


        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(50px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUpStagger {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }



        .dashboard-title {
            font-size: 2rem;
            font-weight: 600;
            color: #2b2d42;
            text-align: center;
            margin-bottom: 30px;
            animation: slideInRight 0.8s ease-out forwards;
            opacity: 0;
        }


        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            animation: slideInLeft 0.8s ease-out 0.3s forwards;
            opacity: 0;
        }

        .card-header {
            background-color: #4e73df;
            color: #fff;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 500;
        }


        .add-product-btn {
            background-color: #ffffff;
            color: #4e73df;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.35s ease;
            box-shadow: 0 2px 8px rgba(78, 115, 223, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .add-product-btn:hover {
            background-color: #2e59d9;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(78, 115, 223, 0.35);
        }


        .card-body {
            padding: 35px 40px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #2b2d42;
        }

        .form-control,
        .form-select,
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d0d7e2;
            border-radius: 8px;
            font-size: 0.95rem;
            background-color: #fff;
            transition: all 0.3s ease;
            color: #333;
            outline: none;
        }


        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #e74a3b !important;
        }

        .form-control:focus,
        .form-select:focus,
        input:focus,
        textarea:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.15);
            transform: scale(1.01);
        }

        .form-control:hover,
        .form-select:hover,
        input:hover,
        textarea:hover {
            border-color: #4e73df;
        }

        button[type="submit"] {
            background-color: #4e73df;
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            transition: all 0.4s ease;
            cursor: pointer;
            font-size: 1rem;
            letter-spacing: 0.3px;
        }

        button[type="submit"]:hover {
            background-color: #2e59d9;
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(78, 115, 223, 0.35);
        }


        .error-message {
            color: #e74a3b;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }


        #colors option {
            background-color: #ffffff;
            color: #333;
        }


        #colors option[value="red"]:checked {
            background-color: red !important;
            color: white !important;
        }

        #colors option[value="blue"]:checked {
            background-color: blue !important;
            color: white !important;
        }

        #colors option[value="black"]:checked {
            background-color: black !important;
            color: white !important;
        }

        #colors option[value="green"]:checked {
            background-color: green !important;
            color: white !important;
        }


        #colors option[value="red"] {
            border-left: 5px solid red;
            padding-left: 5px;
        }

        #colors option[value="blue"] {
            border-left: 5px solid blue;
            padding-left: 5px;
        }

        #colors option[value="black"] {
            border-left: 5px solid black;
            padding-left: 5px;
        }

        #colors option[value="green"] {
            border-left: 5px solid green;
            padding-left: 5px;
        }

        #colors option[value="white"] {
            border-left: 5px solid #ccc;
            padding-left: 5px;
        }

        #colors option[value="yellow"] {
            border-left: 5px solid yellow;
            padding-left: 5px;
        }
    </style>

   

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJdZtO5eNkyLRLC1pA7I7T7Y/5K/z3fI9yL/jFp+3n/j2xJjY5O9q+M9T5Pqg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <main class="dashboard-section">
        <section class="dashboard-container">
            <h1 class="dashboard-title">Create Product</h1>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Products</h4>
                    <a href="{{ route('dashboard') }}" class="add-product-btn">Go Back</a>
                </div>

                <div class="card-body">
                   
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="images">Images (Multiple)</label>
                            {{-- ✅ FIX: Replaced x-text-input with standard input tag --}}
                            <input type="file" name="images[]" multiple 
                                class="form-control {{ $errors->has('images') || $errors->has('images.*') ? 'is-invalid' : '' }}" />
                            @error('images')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                            @error('images.*')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image (Featured)</label>
                            {{-- ✅ FIX: Replaced x-text-input with standard input tag --}}
                            <input type="file" name="image" 
                                class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" />
                            @error('image')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Product Name</label>
                            {{-- ✅ FIX: Replaced x-text-input with standard input tag --}}
                            <input type="text" name="name" placeholder="Enter product name" 
                                value="{{ old('name') }}" 
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" />
                            @error('name')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            {{-- ✅ FIX: Replaced x-text-input with standard input tag --}}
                            <input type="text" name="price" placeholder="Enter original price" 
                                value="{{ old('price') }}" 
                                class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" />
                            @error('price')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            {{-- ✅ FIX: Replaced x-text-input with standard input tag --}}
                            <input type="number" name="quantity" placeholder="Enter stock quantity" 
                                value="{{ old('quantity') }}" 
                                class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" />
                            @error('quantity')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sku">SKU</label>
                           
                            <input type="text" name="sku" placeholder="Unique product code" 
                                value="{{ old('sku') }}" 
                                class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" />
                            @error('sku')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label for="colors" class="block text-gray-700 font-semibold mb-2">Colors</label>
                            <select name="colors[]" id="colors" multiple
                                class="form-select {{ $errors->has('colors') ? 'is-invalid' : '' }}"
                                style="height: 120px;">
                                <option value="" disabled>Select Color(s)</option>

                                @foreach($colors as $color)
                                <option value="{{ $color }}"
                                    {{ in_array($color, old('colors', [])) ? 'selected' : '' }}>
                                    {{ ucfirst($color) }}
                                </option>
                                @endforeach

                            </select>
                            @error('colors')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                          
                            <input type="text" name="tags" placeholder="e.g. laptop, gaming, high-performance" 
                                value="{{ old('tags') }}" 
                                class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" />
                            @error('tags')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            
                            <input type="text" name="short_description" placeholder="Brief summary" 
                                value="{{ old('short_description') }}" 
                                class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" />
                            @error('short_description')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Full Description</label>
                            <textarea name="description" id="editor" rows="5" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Write complete details...">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" style="text-align:center; margin-top:20px;">
                            <button type="submit" class="add-product-btn">Create Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | help',
            license_key: 'gpl'
        });
    </script>

    <script src="{{ asset('js/admin_product_create.js') }}"></script>

</x-app-layout>
