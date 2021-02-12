<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = request()->segment(2);
        return [
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $user_id,
            'password' => 'nullable|string',
        ];
    }
}
