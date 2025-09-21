<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'whatsapp' => 'required|string|max:20',
            'age' => 'required|integer|min:1|max:120',
            'profession' => 'required|string|max:100',
            'gender' => 'required|in:male,female,other',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'telegram' => 'required|string|max:50',
            'fingerprint' => 'required|string',
        ];
    }
}
