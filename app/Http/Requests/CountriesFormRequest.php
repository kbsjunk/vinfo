<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use App;

class CountriesFormRequest extends ModelFormRequest
{
	protected $model = 'country';
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

        $id = $this->route('countries') ?: 'NULL';

        $rules = [
            'code'     => 'required|min:2|max:4|alpha|unique:countries,code,'.$id,
            'name'     => 'required|max:255|unique:country_translations,name,'.$id.',country_id,locale,'.App::getLocale(),
            'common'   => 'boolean',
        ];

        return $rules;
        
    }

}
