<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:10', 'max:65535'],
            'labels' => ['required'],
            'categories' => ['required'],
            'user_files.*' => ['sometimes', 'mimes:pdf,jpg,png,jpeg', 'max:5120']
        ];
    }

    public function messages()
    {
        return [
           'user_files.*.mimes' => 'The only allowed formats are pdf, jpg, jpeg, png'
        ];
    }
}
