<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\CountriesFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\Country;

use App;

class CountriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('show', new Country);

        $countries = Country::withTranslation()
        ->orderByIsActive('desc')
        ->orderBy('is_wine', 'desc')
        ->orderByTranslation('sortas')
        ->paginate(25);

        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = new Country;

        $this->authorize('create', $country);

        return view('countries.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountriesFormRequest $request)
    {
        $country = new Country;

        $this->authorize('create', $country);

        if ($country->fill($request->input())->save()) {
            return redirect(action('CountriesController@edit', $country->id))
                ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('CountriesController@create'))
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
        $country = Country::findOrFail($id);

        $this->authorize('show', $country);

        return view('countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::whereid($id)->firstOrFail();

        $this->authorize('update', $country);

        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountriesFormRequest $request, $id)
    {
        $country = Country::findOrFail($id);

        $this->authorize('update', $country);

        $country->fill($request->input())->save();

        return redirect(action('CountriesController@edit', $id))->with('success', trans('messages.saved_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);

        $this->authorize('destroy', $country);

        if ($country->delete()) {
            return redirect(action('CountriesController@index'))
                ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('CountriesController@edit', $country->id))
            ->with('error', trans('messages.deleted_error'));
    }
    
}
