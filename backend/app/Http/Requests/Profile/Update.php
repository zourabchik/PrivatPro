<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\BaseFormRequest;

class Update extends BaseFormRequest
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
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'middleName' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ];
    }
}
