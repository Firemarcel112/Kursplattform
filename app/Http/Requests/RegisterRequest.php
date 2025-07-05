<?php

namespace App\Http\Requests;

use App\DTO\RegisterUserDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:users,name'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'ascii',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'terms_of_service' => [
                'required',
                'accepted',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('general.name')]),
            'email.required' => __('validation.required', ['attribute' => __('general.email')]),
            'password.required' => __('validation.required', ['attribute' => __('general.password')]),
            'email.email' => __('validation.email', ['attribute' => __('general.email')]),
            'password.min' => __('validation.min.string', ['attribute' => __('general.password'), 'min' => 8]),
            'terms_of_service.required' => __('validation.required', ['attribute' => __('general.terms_of_service')]),
        ];
    }

    /**
     * Wandelt den Request in ein DTO Object um
     *
     * @return RegisterUserDTO
     */
    public function toDTO(): RegisterUserDTO
    {
        $data = $this->validated();
        return new RegisterUserDTO(
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
        );
    }
}
