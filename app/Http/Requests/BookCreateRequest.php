<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'year' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'description' => 'required|string',
            'cover_img_path' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ];
    }
}
