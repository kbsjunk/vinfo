<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use App;

class RegionTypesFormRequest extends ModelFormRequest
{
	protected $model = 'region_type';
	
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

        $id = $this->route('region_types') ?: 'NULL';

        $rules = [
            'name'     => 'required|max:255|unique:region_type_translations,name,'.$id.',region_type_id,locale,'.App::getLocale(),
            'common'   => 'boolean',
        ];

        return $rules;
    }

}
