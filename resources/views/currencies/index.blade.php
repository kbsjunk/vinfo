@extends('layouts/default')

@section('title', trans('sections.currencies'))

@section('content')
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
				<th class="col-sm-1 text-center">{{ trans('models/currency.attributes.code') }}</th>
					<th>{{ trans('models/currency.attributes.name') }}</th>
					@if (App::getLocale() != 'en')
					<th>{{ trans('models/currency.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($currencies as $currency)
				<tr>
					<td class="text-center">{{ $currency->code }}</td>
					<td><a href="{{ action('CurrenciesController@edit', $currency->id) }}">{{ $currency->name }}</a></td>
					@if (App::getLocale() != 'en')
					<td>{{ $currency->name_en }}</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		{!! $currencies->render() !!}
	</div>
</div>
@endsection