@extends('layouts/default')

@section('title', trans('sections.users'))
@section('subtitle', $user->name)

@section('content')
{!! Form::model($user, ['action' => ['UsersController@update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
<div class="panel panel-default">
	<div class="panel-body">
		@include('users.form')
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