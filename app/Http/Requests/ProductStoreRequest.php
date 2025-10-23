<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
       
        $skuRule = ['required', 'string', 'max:50', 'alpha_dash', 'unique:products,sku'];
        
     
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            

            $productId = $this->route('product'); 

           
            $skuRule = [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('products', 'sku')->ignore($productId),
            ];
        }

        return [
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'quantity' => ['required', 'integer', 'min:0'],
            'sku' => $skuRule,
            'status' => ['required', 'boolean'],
            
          
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,webp'], 
            'images' => ['nullable', 'array', 'max:8'],
            'images.*' => ['image', 'max:2048', 'mimes:jpeg,png,jpg,webp'],
            
        
            'colors' => ['nullable', 'array'],
            'colors.*' => ['required_with:colors', 'string', 'max:50'],
            'tags' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
        ];
    }
}
