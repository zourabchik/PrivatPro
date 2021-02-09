<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class Login extends BaseFormRequest
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
        return [
            'phone' => 'required|size:12',
            'password' => 'required|min:8'
        ];
    }
}
