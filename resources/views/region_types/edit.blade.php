@extends('layouts/default')

@section('title', trans('sections.region_types'))
@section('subtitle', $region_type->name)

@section('content')
	{!! Form::model($region_type, ['action' => ['RegionTypesController@update', $region_type->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
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

@section('modals')
@include('modals/delete', ['model' => $region_type, 'controller' => 'RegionTypesController'])
@endsection