@extends('layouts/default')

@section('title', trans('sections.countries'))
@section('subtitle', $country->name)

@section('content')
{!! Form::model($country, ['action' => ['CountriesController@update', $country->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <legend class="sr-only">{{ trans('models/country.name') }}</legend>

    @include('countries.form')

    <div class="form-group">
	    <div class="col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9">
	    	<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
	    	<a href="{{ action('CountriesController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
	    </div>
    </div>
{!! Form::close() !!}
@endsection