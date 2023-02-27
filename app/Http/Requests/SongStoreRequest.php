<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongStoreRequest extends FormRequest
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
        ];
    }
}
