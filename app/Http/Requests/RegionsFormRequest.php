<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use Vinfo\Region;
use App;
use Input;
use Exception;

class RegionsFormRequest extends ModelFormRequest
{
	protected $model = 'region';
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

        $id = $this->route('regions') ?: 'NULL';

        $rules = [
            'name'           => 'required|max:255',
            'parent_id'      => 'exists:regions,id',
            'shortcut_id'    => 'exists:regions,id',
            'country_id'     => 'exists:countries,id',
            'region_type_id' => 'exists:region_types,id',
            'is_structural'  => 'boolean',
        ];

        return $rules;
        
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        $properties = $this->mergeProperties();

        $selects = [
            'parent_id_select'   => Region::getSelect($this->get('parent_id')),
            'shortcut_id_select' => Region::getSelect($this->get('shortcut_id')),
        ];

        $input = array_merge($this->except($this->dontFlash), $selects);

        return $this->redirector->to($this->getRedirectUrl())
                                        ->withInput($input)
                                        ->withErrors($errors, $this->errorBag);
    }

}
