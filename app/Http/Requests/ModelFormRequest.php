<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use Lang;

class ModelFormRequest extends Request
{
	protected $model = 'default';
    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
	public function attributes()
	{
        return array_merge((array) Lang::get('models/default.attributes'), (array) Lang::get('models/'.$this->model.'.attributes'));
    }
}
