<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookRequest extends FormRequest
{
    public function authorize() :bool
    {
        return Auth::check();
    }
    public function rules() :array
    {
        return [
            'id' => 'required|int|exists:books,id'
        ];
    }
}
