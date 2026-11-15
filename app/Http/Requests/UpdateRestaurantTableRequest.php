<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRestaurantTableRequest extends FormRequest
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
            'table_number'=>[
                'required','string','max:255',Rule::unique('restaurant_tables','table_number')->ignore($this->route('restaurant_table'))
            ],
            'capacity' => 'required|integer|min:1',
            'status' => 'sometimes|in:available,occupied,reserved',

        ];
    }
}
