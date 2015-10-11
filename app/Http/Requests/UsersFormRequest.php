<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use App;
use Lang;

class UsersFormRequest extends Request
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

        $id = $this->route('users') ?: 'NULL';

        $rules = [
            'email'       => 'required|email|unique:users,email,'.$id,
            'name'        => 'required|min:2',
            'is_admin'    => 'boolean',
            'country_id'  => 'required|exists:countries,id',
            'language_id' => 'required|exists:languages,id',
            'currency_id' => 'required|exists:currencies,id',
        ];

        // dd($rules);

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return Lang::get('models/user.attributes');
    }
}
