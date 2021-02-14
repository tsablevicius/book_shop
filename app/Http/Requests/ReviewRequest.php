<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'book_id' => 'required|exists:books,id',
            'rating' => 'required_without:comment|min:1|max:5',
            'comment' => 'required_without:rating'
        ];
    }
}
