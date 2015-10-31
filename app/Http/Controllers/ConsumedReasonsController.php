<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\ConsumedReasonsFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\ConsumedReason;

class ConsumedReasonsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('show', new ConsumedReason);

        $consumed_reasons = ConsumedReason::withTranslation()
        ->orderBy('is_drank', 'desc')
        ->orderByTranslation('sortas')->paginate(25);

        return view('consumed_reasons.index', compact('consumed_reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consumed_reason = new ConsumedReason;

        $this->authorize('create', $consumed_reason);

        return view('consumed_reasons.create', compact('consumed_reason'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumedReasonsFormRequest $request)
    {
        $consumed_reason = new ConsumedReason;

        $this->authorize('create', $consumed_reason);

        if ($consumed_reason->fill($request->input())->save()) {
            return redirect(action('ConsumedReasonsController@edit', $consumed_reason->id))
                ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('ConsumedReasonsController@create'))
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
        $consumed_reason = ConsumedReason::findOrFail($id);

        $this->authorize('show', $consumed_reason);

        return view('consumed_reasons.show', compact('consumed_reason'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consumed_reason = ConsumedReason::whereid($id)->firstOrFail();

        $this->authorize('update', $consumed_reason);

        return view('consumed_reasons.edit', compact('consumed_reason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumedReasonsFormRequest $request, $id)
    {
        $consumed_reason = ConsumedReason::findOrFail($id);

		dd($request->input());
		
        $this->authorize('update', $consumed_reason);

        $consumed_reason->fill($request->input())->save();

        return redirect(action('ConsumedReasonsController@edit', $id))->with('success', trans('messages.saved_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consumed_reason = ConsumedReason::findOrFail($id);

        $this->authorize('destroy', $consumed_reason);

        if ($consumed_reason->delete()) {
            return redirect(action('ConsumedReasonsController@index'))
                ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('ConsumedReasonsController@edit', $consumed_reason->id))
            ->with('error', trans('messages.deleted_error'));
    }
    
}
