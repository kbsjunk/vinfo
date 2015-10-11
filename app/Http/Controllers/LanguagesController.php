<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\LanguagesFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\Language;

class LanguagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('show', new Language);

        $languages = Language::orderBy('name')->paginate(25);

        return view('languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Language);

        return view('languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguagesFormRequest $request)
    {
        $language = new Language;

        $this->authorize('create', $language);

        if ($language->fill($request->input())->save()) {
            return redirect(action('LanguagesController@edit', $language->id))
                ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('LanguagesController@create'))
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
        $language = Language::findOrFail($id);

        $this->authorize('show', $language);

        return view('languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);

        $this->authorize('update', $language);

        return view('languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguagesFormRequest $request, $id)
    {
        $language = Language::findOrFail($id);

        $this->authorize('update', $language);

        $language->fill($request->input())->save();

        return redirect(action('LanguagesController@edit', $id))->with('success', trans('messages.saved_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id);

        $this->authorize('destroy', $language);

        if ($language->delete()) {
            return redirect(action('LanguagesController@index'))
                ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('LanguagesController@edit', $language->id))
            ->with('error', trans('messages.deleted_error'));
    }

}
