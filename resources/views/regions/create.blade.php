@extends('layouts/default')

@section('title', trans('sections.regions'))
@section('subtitle', trans('actions.new'))

@section('content')
{!! Form::open(['action' => 'RegionsController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/region.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('regions.form')
	</div>

	<div class="panel-footer">
		<div class="col-sm-offset-1">
			<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
			<a href="{{ action('RegionsController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection