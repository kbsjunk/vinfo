@extends('layouts/default')

@section('title', trans('sections.geometries'))
@section('subtitle', $geometry->name)

@section('content')
{!! Form::model($geometry, ['action' => ['GeometriesController@update', $geometry->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/geometry.name') }}</legend>
<div class="panel map-preview">
	<div class="panel-body">
		@include('geometries/preview')
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		@include('geometries.form')
	</div>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-1 col-sm-11">
				<button type="submit" class="btn btn-primary btn-block-sm">{{ trans('actions.save') }}</button>
				<a href="{{ action('GeometriesController@index') }}" class="btn btn-link btn-block-sm">{{ trans('actions.cancel') }}</a>
				@can('destroy', $geometry)
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
@include('modals/delete', ['model' => $geometry, 'controller' => 'GeometriesController'])
@endsection