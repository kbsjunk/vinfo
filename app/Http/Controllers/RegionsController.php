<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\RegionsFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\Region;
use Vinfo\RegionType;
use Vinfo\Country;

class RegionsController extends Controller
{

    private function getDropdowns()
    {
        $countries = Country::withTranslation()->whereIsActive()->orderByTranslation('sortas')->get()->lists('name', 'id');
        $region_types = RegionType::withTranslation()->orderByTranslation('sortas')->get()->lists('name', 'id');

        view()->share('countries', $countries);
        view()->share('region_types', $region_types);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$region = new Region;
        $this->authorize('show', $region);

        $regions = Region::with(['regionType', 'country'])
			// ->where('regions.country_id', 765)
			->orderByRelationTranslation('country', 'sortas')
			->orderBy($region->getQualifiedOrderColumnName())
			->paginate(25);

        return view('regions.index', compact('regions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  //   public function countryIndex(Country $country)
  //   {
		// $region = new Region;
  //       $this->authorize('show', $region);

  //       $regions = Region::withTranslation()
		// 	->with('regionType', 'country')
		// 	->orderBy($region->getQualifiedOrderColumnName())
		// 	->paginate(25);

  //       return view('regions.index', compact('regions'));
  //   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = new Region;

        $this->authorize('create', $region);

        $this->getDropdowns();

        $mode = 'create';

        return view('regions.create', compact('region', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionsFormRequest $request)
    {
        $region = new Region;

        $this->authorize('create', $region);

        if ($region->fill($request->input())->save()) {
            return redirect(action('RegionsController@edit', $region->id))
                ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('RegionsController@create'))
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
        $region = Region::findOrFail($id);

        $this->authorize('show', $region);

        return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::whereid($id)->firstOrFail();

        $this->authorize('update', $region);

        $this->getDropdowns();

        $mode = 'edit';

        return view('regions.edit', compact('region', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegionsFormRequest $request, $id)
    {
        $region = Region::findOrFail($id);

        $this->authorize('update', $region);

        $region->fill($request->input())->save();

        return redirect(action('RegionsController@edit', $id))->with('success', trans('messages.saved_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::findOrFail($id);

        $this->authorize('destroy', $region);

        if ($region->delete()) {
            return redirect(action('RegionsController@index'))
                ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('RegionsController@edit', $region->id))
            ->with('error', trans('messages.deleted_error'));
    }
    
}
