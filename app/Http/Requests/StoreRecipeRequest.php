<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->input('intent') === 'draft') {
            return [
                'title' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:5000'],
                'ingredients' => ['nullable', 'string', 'max:10000'],
                'steps' => ['nullable', 'array'],
                'steps.*' => ['nullable', 'string', 'max:1000'],
                'closing' => ['nullable', 'string', 'max:3000'],
                'prep_time' => ['nullable', 'integer', 'min:0', 'max:1440'],
            ];
        }

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'ingredients' => ['required', 'string', 'max:10000'],
            'steps' => ['required', 'array', 'min:1'],
            'steps.*' => ['required', 'string', 'max:1000'],
            'closing' => ['nullable', 'string', 'max:3000'],
            'prep_time' => ['nullable', 'integer', 'min:0', 'max:1440'],
        ];
    }
}
