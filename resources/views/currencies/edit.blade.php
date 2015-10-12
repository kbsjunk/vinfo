@extends('layouts/default')

@section('title', trans('sections.currencies'))
@section('subtitle', $currency->name)

@section('content')
{!! Form::model($currency, ['action' => ['CurrenciesController@update', $currency->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/currency.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('currencies.form')
	</div>

	<div class="panel-footer">
		<div class="col-sm-offset-1">
			<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
			<a href="{{ action('CurrenciesController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection