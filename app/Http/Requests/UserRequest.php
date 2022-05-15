<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            "username"      =>["required",Rule::unique('users')->ignore($this->user)],
            "email"         =>["required",Rule::unique('users')->ignore($this->user)],
            "is_admin"      =>["nullable","boolean"],
        ];
    }
}
