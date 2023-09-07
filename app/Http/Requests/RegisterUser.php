<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUser extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required' ,
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'succes' => 'false',
            'status_code' => 422,
            'error' => 'true',
            'message' => 'Erreur de validation',
            'errorList' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required'=> 'Un nom doit etre fourni',
            'email.required'=> 'Un adresse email doit etre fourni',
            'email.unique'=> 'cette adresse email existe déjà',
            'password.required'=> 'Ce mot de passe est requis'
        ];
    }
}
