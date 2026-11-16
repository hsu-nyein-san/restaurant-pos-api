<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_table_id'=>'nullable|exists:restaurant_tables,id',
            'items'=>'required|array|min:1',
            'item.*.product_id'=>'required|exists:products,id',
            'item.*.quantity'=>'required|integer|min:1',
            'discount'=>'nullable|numeric|min:0',
            'tax'=>'nullable|numeric|min:0'
        ];
    }
}
