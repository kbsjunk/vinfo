@extends('layouts/default')

@section('title', trans('sections.bottle_sizes'))
@section('subtitle', trans('actions.new'))

@section('content')
{!! Form::open(['action' => 'BottleSizesController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <legend class="sr-only">{{ trans('models/bottle_size.name') }}</legend>

    @include('bottle_sizes.form')

    <div class="form-group">
	    <div class="col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9">
	    	<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
	    	<a href="{{ action('BottleSizesController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
	    </div>
    </div>
{!! Form::close() !!}
@endsection