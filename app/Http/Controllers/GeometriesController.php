<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\GeometriesFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\Geometry;
use Lang;
use Input;

class GeometriesController extends Controller
{
    private function getDropdowns()
    {
        $shapeKeys = ['point', 'linestring', 'polygon', 'multipoint', 'multilinestring', 'multipolygon', 'geometrycollection'];
        $shapes = [];

        foreach ($shapeKeys as $key) {
            $shapes[$key] = Lang::get('models/geometry.types.'.$key);
        }

        $formats = ['geojson' => 'GeoJSON', 'kml' => 'KML'];

        $relatedRecordKeys = ['Region', 'Country', 'Winery'];
        $relatedRecords = [];

        foreach ($relatedRecordKeys as $key) {
            $relatedRecords[$key] = Lang::get('models/'.strtolower($key).'.name');
        }

        view()->share('shapes', $shapes);
        view()->share('formats', $formats);
        view()->share('relatedRecords', $relatedRecords);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('show', new Geometry);

        $geometries = Geometry::orderBy('id')->paginate(25);

        return view('geometries.index', compact('geometries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $geometry = new Geometry;

        $this->authorize('create', $geometry);

        $this->getDropdowns();

        return view('geometries.create', compact('geometry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeometriesFormRequest $request)
    {
        $geometry = new Geometry;

        $this->authorize('create', $geometry);

        if ($this->saveGeometry($geometry, $request)) {
            return redirect(action('GeometriesController@edit', $geometry->id))
            ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('GeometriesController@create'))
        ->withInput()
        ->with('error', trans('messages.saved_error'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $geometry = Geometry::findOrFail($id);

        $this->authorize('show', $geometry);

        return view('geometries.show', compact('geometry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $geometry = Geometry::whereid($id)->firstOrFail();

        $this->authorize('update', $geometry);

        $this->getDropdowns();

        return view('geometries.edit', compact('geometry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GeometriesFormRequest $request, $id)
    {
        $geometry = Geometry::findOrFail($id);

        $this->authorize('update', $geometry);

        $this->saveGeometry($geometry, $request);

        return redirect(action('GeometriesController@edit', $id))->with('success', trans('messages.saved_success'));
    }

    private function saveGeometry($geometry, $request)
    {
      $input = array_merge($request->except(['property_keys', 'property_names']), $request->mergeProperties());

      $geometry->fill($input);

      if ($request->get('geometried_id') && $request->get('geometried_type')) {

        $geometried = $geometry->getActualClassNameForMorph($request->get('geometried_type'));
        $geometried = with(new $geometried)->find($request->get('geometried_id'));

        $geometry->geometried()->associate($geometried);
    }
    else {
        $geometry->geometried()->dissociate();
    }

    return $geometry->save();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $geometry = Geometry::findOrFail($id);

        $this->authorize('destroy', $geometry);

        if ($geometry->delete()) {
            return redirect(action('GeometriesController@index'))
            ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('GeometriesController@edit', $geometry->id))
        ->with('error', trans('messages.deleted_error'));
    }

    public function searchGeometried()
    {
        $type = Input::get('geometried_type');
        $query = Input::get('query');

        $results = [];

        if (in_array($type, ['Region', 'Country', 'Winery'])) {
            $type = '\\Vinfo\\'.$type;
            $model = new $type;
            $results = $model->whereTranslationLike('name', "%$query%");

            if ($type == '\\Vinfo\\Region') {
                $results->where('is_structural', 0)->where('shortcut_id', null)
                ->with('country', 'regionType');
            }

            $results = $results->get();
        }

        return ['data' => $results];
    }
    
}
