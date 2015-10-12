<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use App;

class BottleSizesFormRequest extends ModelFormRequest
{
	protected $model = 'bottle_size';
	
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

}
