<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'singer_id' => ['required', 'integer', 'exists:singers,id'],
            'name' => ['required', 'string'],
            'year' => ['required', 'integer', 'min:1900', 'max:'.now()->year],
        ];
    }
}
