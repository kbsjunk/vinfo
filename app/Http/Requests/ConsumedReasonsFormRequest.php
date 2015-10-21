<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use App;

class ConsumedReasonsFormRequest extends ModelFormRequest
{
    protected $model = 'consumed_reason';
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

        $id = $this->route('consumed_reasons') ?: 'NULL';

        $rules = [
            'name'     => 'required|max:255|unique:consumed_reason_translations,name,'.$id.',consumed_reason_id,locale,'.App::getLocale(),
            'common'   => 'boolean',
        ];

        return $rules;
        
    }

}
