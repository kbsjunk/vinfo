@extends('layouts/default')

@section('title', trans('sections.languages'))
@section('subtitle', $language->name)

@section('content')
{!! Form::model($language, ['action' => ['LanguagesController@update', $language->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
<legend class="sr-only">{{ trans('models/language.name') }}</legend>
<div class="panel panel-default">
	<div class="panel-body">
		@include('languages.form')
	</div>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-1 col-sm-11">
				<button type="submit" class="btn btn-primary btn-block-sm">{{ trans('actions.save') }}</button>
				<a href="{{ action('LanguagesController@index') }}" class="btn btn-link btn-block-sm">{{ trans('actions.cancel') }}</a>
				@can('destroy', $language)
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
@include('modals/delete', ['model' => $language, 'controller' => 'LanguagesController'])
@endsection