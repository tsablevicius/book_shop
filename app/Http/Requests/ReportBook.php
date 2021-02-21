<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReportBook extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }
    public function rules(): array
    {
        return [
            'book_id' => 'required|exists:books,id',
            'email' => 'required|email|exists:users,email',
            'comment' => 'required|string'
        ];
    }
}
