@extends('layouts/default')

@section('title', trans('sections.consumed_reasons'))
@section('subtitle', $consumed_reason->name)

@section('content')
{!! Form::model($consumed_reason, ['action' => ['ConsumedReasonsController@update', $consumed_reason->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/consumed_reason.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('consumed_reasons.form')
	</div>

	<div class="panel-footer">
		<div class="col-sm-offset-1">
			<button type="submit" class="btn btn-primary">{{ trans('actions.save') }}</button>
			<a href="{{ action('ConsumedReasonsController@index') }}" class="btn btn-link">{{ trans('actions.cancel') }}</a>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection

@section('modals')
@include('modals/delete', ['model' => $consumed_reason, 'controller' => 'ConsumedReasonController'])
@endsection