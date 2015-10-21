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
		<div class="row">
			<div class="col-sm-offset-1 col-sm-11">
				<button type="submit" class="btn btn-primary btn-block-sm">{{ trans('actions.save') }}</button>
				<a href="{{ action('BottleSizesController@index') }}" class="btn btn-link btn-block-sm">{{ trans('actions.cancel') }}</a>
				@can('destroy', $bottle_size)
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
@include('modals/delete', ['model' => $bottle_size, 'controller' => 'BottleSizesController'])
@endsection