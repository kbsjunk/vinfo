<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\BottleSizesFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\BottleSize;

class BottleSizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $bottle_sizes = BottleSize::orderBy('is_common', 'desc')->orderBy('capacity')->paginate(25);

        return view('bottle_sizes.index', compact('bottle_sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bottle_sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BottleSizesFormRequest $request)
    {
        $bottle_size = new BottleSize;

        if ($bottle_size->fill($request->input())->save()) {
            return redirect(action('BottleSizesController@edit', $bottle_size->id))
                ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('BottleSizesController@create'))
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
        $bottle_size = BottleSize::findOrFail($id);

        return view('bottle_sizes.show', compact('bottle_size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bottle_size = BottleSize::whereid($id)->firstOrFail();

        return view('bottle_sizes.edit', compact('bottle_size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BottleSizesFormRequest $request, $id)
    {
        $bottle_size = BottleSize::findOrFail($id);

        $bottle_size->fill($request->input())->save();

        return redirect(action('BottleSizesController@edit', $id))->with('success', trans('messages.saved_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bottle_size = BottleSize::findOrFail($id);

        if ($bottle_size->delete()) {
            return redirect(action('BottleSizesController@index'))
                ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('BottleSizesController@edit', $bottle_size->id))
            ->with('error', trans('messages.deleted_error'));
    }
}
