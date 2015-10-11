<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use App;
use Lang;

class BottleSizesFormRequest extends Request
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

        $id = $this->route('bottle_sizes') ?: 'NULL';

        $rules = [
            'name'     => 'required|unique:bottle_size_translations,name,'.$id.',bottle_size_id,locale,'.App::getLocale(),
            'capacity' => 'required|numeric',
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
