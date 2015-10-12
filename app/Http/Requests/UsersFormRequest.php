<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;

class UsersFormRequest extends ModelFormRequest
{
	protected $model = 'user';
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

        $id = $this->route('users') ?: 'NULL';

        $rules = [
            'email'       => 'required|email|unique:users,email,'.$id,
            'name'        => 'required|min:2',
            'is_admin'    => 'boolean',
            'country_id'  => 'required|exists:countries,id',
            'language_id' => 'required|exists:languages,id',
            'currency_id' => 'required|exists:currencies,id',
            'password' => 'confirmed|min:6',
            'password_confirmation' => 'required_with:password',
        ];

        if ($id == 'NULL') {
			$rules['password'] .= '|required';
		}

        return $rules;
    }

}
