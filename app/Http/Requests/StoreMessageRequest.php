<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        $rules = [
            'message' => 'required|string'
        ];

        $rules['user_id'] = [
            'required',
            Rule::exists('users', 'id')->whereNotNull('email_verified_at')
        ];

        return $rules;
    }
}
