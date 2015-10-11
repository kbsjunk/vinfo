<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\CurrenciesFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\Currency;

class CurrenciesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('show', new Currency);

        $currencies = Currency::orderByTranslation('name')->paginate(25);

        return view('currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Currency);

        return view('currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrenciesFormRequest $request)
    {
        $currency = new Currency;

        $this->authorize('create', $currency);

        if ($currency->fill($request->input())->save()) {
            return redirect(action('CurrenciesController@edit', $currency->id))
                ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('CurrenciesController@create'))
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
        $currency = Currency::findOrFail($id);

        $this->authorize('show', $currency);

        return view('currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);

        $this->authorize('update', $currency);

        return view('currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrenciesFormRequest $request, $id)
    {
        $currency = Currency::findOrFail($id);

        $this->authorize('update', $currency);

        $currency->fill($request->input())->save();

        return redirect(action('CurrenciesController@edit', $id))->with('success', trans('messages.saved_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);

        $this->authorize('destroy', $currency);

        if ($currency->delete()) {
            return redirect(action('CurrenciesController@index'))
                ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('CurrenciesController@edit', $currency->id))
            ->with('error', trans('messages.deleted_error'));
    }

}
