@extends('layouts/default')

@section('title', trans('sections.countries'))

@section('content')
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">{{ trans('models/country.attributes.code') }}</th>
					<th>{{ trans('models/country.attributes.name') }}</th>
					@if (App::getLocale() != 'en')
					<th>{{ trans('models/country.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
					@endif
					<th class="col-md-1">{{ trans('models/country.attributes.is_active') }}</th>
					<th class="col-md-1">{{ trans('models/country.attributes.is_wine') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($countries as $country)
				<tr>
				<td class="text-center">{{ $country->code }}</td>
					<td><a href="{{ action('CountriesController@edit', $country->id) }}">{{ $country->name }}</a></td>
					@if (App::getLocale() != 'en')
					<td>{{ $country->name_en }}</td>
					@endif
					<td>{{ $country->is_active ? trans('messages.yes') : trans('messages.no') }}</td>
					<td>{{ $country->is_wine ? trans('messages.yes') : trans('messages.no') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		{!! $countries->render() !!}
	</div>
</div>
@endsection