@extends('layouts/default')

@section('title', trans('sections.account'))
@section('subtitle', $user->name)

@section('content')
{!! Form::model($user, ['action' => ['UsersController@postAccount', $user->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/user.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('users.form_profile')
	</div>

	<div class="panel-footer">
		<div class="col-sm-offset-1">
			<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
			<a href="{{ action('UsersController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection