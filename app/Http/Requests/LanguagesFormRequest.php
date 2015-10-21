<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;

class LanguagesFormRequest extends ModelFormRequest
{
	protected $model = 'language';
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
            'code'     => 'required|min:2|max:20|alpha_dash|unique:languages,code,'.$id,
            'name'     => 'required|max:255|unique:languages,name,'.$id,
            'common'   => 'boolean',
        ];

        return $rules;
    }

}
