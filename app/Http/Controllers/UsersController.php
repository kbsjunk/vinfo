<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests\UsersFormRequest;
use Vinfo\Http\Requests\UserProfileFormRequest;
use Vinfo\Http\Controllers\Controller;
use Vinfo\User;
use Vinfo\Country;
use Vinfo\Language;
use Vinfo\Currency;
use Auth;

class UsersController extends Controller
{

    private function getDropdowns()
    {
        $countries = Country::withTranslation()->orderByTranslation('name')->get()->lists('name', 'id');
        $languages = Language::orderBy('name')->get()->lists('name', 'id');
        $currencies = Currency::withTranslation()->orderByTranslation('name')->get()->lists('name', 'id');

        view()->share('countries', $countries);
        view()->share('languages', $languages);
        view()->share('currencies', $currencies);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('show', new User);

        $users = User::orderBy('name')->paginate(25);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new User);

        $this->getDropdowns();

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersFormRequest $request)
    {
        $user = new User;

        $this->authorize('create', $user);

        $user->fill($request->input());

        $user->password = bcrypt($request->input('password'));

        if ($user->save()) {
            return redirect(action('UsersController@edit', $user->id))
                ->with('success', trans('messages.saved_success'));
        }

        return redirect(action('UsersController@create'))
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
        $user = User::findOrFail($id);

        $this->authorize('show', $user);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::whereid($id)->firstOrFail();

        $this->authorize('update', $user);

        $this->getDropdowns();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersFormRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        $user->fill($request->input());

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        $response = redirect(action('UsersController@edit', $id))->with('success', trans('messages.saved_success'));

        if ($request->has('password')) {
            $response->with('successes', [trans('passwords.reset')]);
        }

        return $response;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAccount()
    {
        $user = Auth::user();

        $this->getDropdowns();

        return view('users.edit_profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postAccount(UserProfileFormRequest $request)
    {
        $user = Auth::user();

        $this->authorize('update', $user);

        $user->fill($request->except(['is_admin']));

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        $response = redirect(action('UsersController@getAccount'))->with('success', trans('messages.saved_success'));

        if ($request->has('password')) {
            $response->with('successes', [trans('passwords.reset')]);
        }

        return $response;
    }

    public function setLanguage($language)
    {
        $user = Auth::user();

        $this->authorize('update', $user);

        $language = Language::whereCode($language)->firstOrFail();

        $user->language_id = $language->id;

        $user->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('destroy', $user);

        if ($user->delete()) {
            return redirect(action('UsersController@index'))
                ->with('success', trans('messages.deleted_success'));
        }

        return redirect(action('UsersController@edit', $user->id))
            ->with('error', trans('messages.deleted_error'));
    }
    
}
