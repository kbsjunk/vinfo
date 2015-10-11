<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use App;
use Lang;

class CurrenciesFormRequest extends Request
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

        $id = $this->route('currencies') ?: 'NULL';

        $rules = [
            'code'     => 'required|size:3|alpha|unique:currencies,code,'.$id,
            'name'     => 'required|unique:currency_translations,name,'.$id.',currency_id,locale,'.App::getLocale(),
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
        return Lang::get('models/currency.attributes');
    }
}
