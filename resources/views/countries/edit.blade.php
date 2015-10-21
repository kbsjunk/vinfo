@extends('layouts/default')

@section('title', trans('sections.countries'))
@section('subtitle', $country->name)

@section('content')
{!! Form::model($country, ['action' => ['CountriesController@update', $country->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/country.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('countries.form')
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
@include('modals/delete', ['model' => $country, 'controller' => 'CountriesController'])
@endsection