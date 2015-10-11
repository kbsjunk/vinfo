@extends('layouts/default')

@section('title', trans('sections.countries'))

@section('content')
<div class="table-responsive">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th class="col-sm-1">{{ trans('models/country.attributes.code') }}</th>
				<th>{{ trans('models/country.attributes.name') }}</th>
				@if (App::getLocale() != 'en')
				<th>{{ trans('models/country.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($countries as $country)
			<tr>
				<td>{{ $country->code }}</td>
				<td><a href="{{ action('CountriesController@edit', $country->id) }}">{{ $country->name }}</a></td>
				@if (App::getLocale() != 'en')
				<td>{{ $country->name_en }}</td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! $countries->render() !!}
@endsection