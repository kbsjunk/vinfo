@extends('layouts/default')

@section('title', trans('sections.currencies'))
@section('subtitle', trans('actions.new'))

@section('content')
{!! Form::open(['action' => 'CurrenciesController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <legend class="sr-only">{{ trans('models/currency.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('currencies.form', ['currency' => new Vinfo\Currency])
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