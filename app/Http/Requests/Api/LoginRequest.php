<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\UserTypes;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class LoginRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
      throw new HttpResponseException(
        response()->json([
          'errors' => $validator->errors(),
          'message' => __('invalid email or Password'),
        ], 422)
      );
    }
    public function rules(): array
    {
        return [
          'email' => [
            'required',
            Rule::exists('users')->where(function ($query) {
              $query->where('is_active', true);
            }),
          ],
            'password' => 'required',
          ];
    }
}
