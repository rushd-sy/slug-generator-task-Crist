<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Filtering
            'search' => ['nullable', 'string', 'max:200'],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0'],
            'in_stock' => ['nullable', 'boolean'],

            // Sorting: comma-separated list, prefix with '-' for desc.
            // Example: sort=title,-price
            'sort' => ['nullable', 'string', 'max:200'],

            // Pagination
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
