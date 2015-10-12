@extends('layouts/default')

@section('title', trans('sections.bottle_sizes'))
@section('subtitle', $bottle_size->name)

@section('content')
{!! Form::model($bottle_size, ['action' => ['BottleSizesController@update', $bottle_size->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/bottle_size.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('bottle_sizes.form')
	</div>

	<div class="panel-footer">
		<div class="col-sm-offset-1">
			<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
			<a href="{{ action('BottleSizesController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection