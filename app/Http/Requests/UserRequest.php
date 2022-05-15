<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name"    =>["required"],
            "last_name"     =>["required"],
            "username"      =>["required","unique:users,username"],
            "email"         =>["required","unique:users,email"],
            "password"      =>["required"],
            "is_admin"      =>["required","boolean"],
        ];
    }
}
