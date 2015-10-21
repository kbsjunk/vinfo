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
		<div class="row">
			<div class="col-sm-offset-1 col-sm-11">
				<button type="submit" class="btn btn-primary btn-block-sm">{{ trans('actions.save') }}</button>
				<a href="{{ action('CountriesController@index') }}" class="btn btn-link btn-block-sm">{{ trans('actions.cancel') }}</a>
				@can('destroy', $country)
				<hr class="visible-xs">
				<button type="button" class="btn btn-danger btn-block-sm pull-right" data-toggle="modal" data-target="#delete-modal">
					{{ trans('actions.delete') }}
				</button>
				@endcan
			</div>
		</div>
	</div>
</div>
	{!! Form::close() !!}
@endsection

@section('modals')
@include('modals/delete', ['model' => $region_type, 'controller' => 'RegionTypesController'])
@endsection