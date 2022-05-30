<?php

namespace App\Http\Requests;

use App\Models\User;
// use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DeplacementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_id"           =>["required"],
            "id_vehicule"       =>["required"],
            "date"              =>["required"],
            "intitule"          =>["required"],
            "peage"             =>["nullable"],
            "gasoil"            =>["nullable"],
            "ptm"               =>["nullable"],
            "nb_km"             =>["nullable"],
            "f_divers"          =>["nullable"],
            "m_divers"          =>["nullable"],
            "infos"             =>["nullable","boolean"],
            "t_repas"           =>["nullable"],
            "nb_repas"          =>["nullable"],
            "m_hotel"           =>["nullable"],
            "valider"           =>["nullable","boolean"],
            "imprime"           =>["nullable","boolean"],
            "d_imp"             =>["nullable"],
        ];
    }
}
