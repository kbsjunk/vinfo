@extends('layouts/default')

@section('title', trans('sections.account'))
@section('subtitle', $user->name)

@section('content')
{!! Form::model($user, ['action' => ['UsersController@postAccount', $user->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <legend class="sr-only">{{ trans('models/user.name') }}</legend>

    @include('users.form_profile')

    <hr>
    <div class="form-group">
	    <div class="col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9">
	    	<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
	    	<a href="{{ action('UsersController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
	    </div>
    </div>
{!! Form::close() !!}
@endsection