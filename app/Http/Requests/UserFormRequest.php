<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\UserType;

class UserFormRequest extends FormRequest
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
            'nombre'     => 'required',
            'telefono'   => 'required',
            'email'      => 'nullable|email|unique:users,email',
            'direccion'  => 'nullable',
            'nacimiento' => 'nullable|date',
            'id_uType'   => 'required',
        ];
    }
}
