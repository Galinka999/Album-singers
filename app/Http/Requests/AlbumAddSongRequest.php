<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumAddSongRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'songs.*.song_id' => ['required', 'integer', 'exists:songs,id'],
            'songs.*.place' => ['required', 'integer'],
        ];
    }
}
