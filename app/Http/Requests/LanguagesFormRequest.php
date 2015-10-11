<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use App;
use Lang;

class LanguagesFormRequest extends Request
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

        $id = $this->route('languages') ?: 'NULL';

        $rules = [
            'code'     => 'required|min:2|alpha_dash|unique:languages,code,'.$id,
            'name'     => 'required|unique:languages,name,'.$id,
            'common'   => 'boolean',
        ];

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return Lang::get('models/language.attributes');
    }
}
