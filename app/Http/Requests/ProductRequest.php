<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('manage',Product::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required', 'min:3'],
            'price'=> ['required', 'numeric'],
            'description'=> 'required',
            'photo'=> ['required', 'image'],
            'category_id'=> 'required'
        ];
    }
    public function messages(): array
    {
        return[
            'category_id.required'=> "Please Selecte a Category"
        ];
    }
}
