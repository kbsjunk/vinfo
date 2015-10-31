<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\RegionTypesFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\RegionType;

class RegionTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $this->authorize('show', new RegionType);

        $region_types = RegionType::withTranslation()->orderByTranslation('sortas')->paginate(25);

        return view('region_types.index', compact('region_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region_type = new RegionType;

        $this->authorize('create', $region_type);

        return view('region_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionTypesFormRequest $request)
    {
        $region_type = new RegionType;

        $this->authorize('create', $region_type);

        if ($region_type->fill($request->input())->save()) {
            return redirect(action('RegionTypesController@edit', $region_type->id))
                ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('RegionTypesController@create'))
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
        $region_type = RegionType::findOrFail($id);

        $this->authorize('show', $region_type);

        return view('region_types.show', compact('region_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region_type = RegionType::whereid($id)->firstOrFail();

        $this->authorize('update', $region_type);

        return view('region_types.edit', compact('region_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegionTypesFormRequest $request, $id)
    {
        $region_type = RegionType::findOrFail($id);

        $this->authorize('update', $region_type);

        $region_type->fill($request->input())->save();

        return redirect(action('RegionTypesController@edit', $id))->with('success', trans('messages.saved_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region_type = RegionType::findOrFail($id);

        $this->authorize('destroy', $region_type);

        if ($region_type->delete()) {
            return redirect(action('RegionTypesController@index'))
                ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('RegionTypesController@edit', $region_type->id))
            ->with('error', trans('messages.deleted_error'));
    }
}
