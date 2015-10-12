@extends('layouts/default')

@section('title', trans('sections.languages'))
@section('subtitle', trans('actions.new'))

@section('content')
{!! Form::open(['action' => 'LanguagesController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/language.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('languages.form')
	</div>

	<div class="panel-footer">
		<div class="col-sm-offset-1">
			<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
			<a href="{{ action('LanguagesController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection