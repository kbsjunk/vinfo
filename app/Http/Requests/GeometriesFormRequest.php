<?php

namespace Vinfo\Http\Requests;

use Vinfo\Http\Requests\Request;
use Vinfo\Geometry;
use App;
use Input;
use Exception;

class GeometriesFormRequest extends ModelFormRequest
{
	protected $model = 'geometry';
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

        $id = $this->route('geometries') ?: 'NULL';

        $relatedTable = '';

        if (Input::has('geometried_type')) {
            $relatedTable = 'Vinfo\\'.Input::get('geometried_type');

            try {
                $relatedTable = new $relatedTable;
                $relatedTable = '|exists:'.$relatedTable->getTable().',id';
            }
            catch (Exception $e) {
                $relatedTable = '';
            }
            
        }

        $rules = [
            'name'            => 'required|max:255',
            'geometry_json'   => 'required|json|geometry',
            'shape'           => 'required|in:point,linestring,polygon,muiltipoint,multilinestring,multipolygon,geometrycollection',
            'quality'         => 'numeric',
            'geometried_type' => 'required_with:geometried_id|in:Region,Country,Winery',
            'geometried_id'   => 'required_with:geometried_type'.$relatedTable,
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

        $geometriedSelect = ['geometried_select' => Geometry::getGeometriedSelect($this->get('geometried_id'), $this->get('geometried_type'))];

        $input = array_merge($this->except(array_merge($this->dontFlash, ['property_keys', 'property_names'])), $properties, $geometriedSelect);

        return $this->redirector->to($this->getRedirectUrl())
                                        ->withInput($input)
                                        ->withErrors($errors, $this->errorBag);
    }

    public function mergeProperties()
    {
        return ['properties' => array_filter(array_combine((array) $this->get('property_keys'), (array) $this->get('property_names')))];
    }

}
