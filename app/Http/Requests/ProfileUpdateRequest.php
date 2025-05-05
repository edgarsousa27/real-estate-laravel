<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nationality' => ['required', 'string'],
            'identification_number' => ['required', 'digits:8', 'integer'],
            'tax_number' => ['required', 'digits:9', 'integer'],
            'phone_number' => ['required', 'digits:9', 'integer'],
            'date_of_birth' => ['required', 'date'],
        ];
    }
}
