@extends('layouts/default')

@section('title', trans('sections.region_types'))
@section('subtitle', trans('actions.new'))

@section('content')
{!! Form::open(['action' => 'RegionTypesController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/region_type.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('region_types.form')
	</div>

	<div class="panel-footer">
		<div class="col-sm-offset-1">
			<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
			<a href="{{ action('RegionTypesController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection