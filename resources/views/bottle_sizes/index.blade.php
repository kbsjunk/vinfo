@extends('layouts/default')

@section('title', trans('sections.bottle_sizes'))

@section('content')
<div class="table-responsive">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>{{ trans('models/bottle_size.attributes.name') }}</th>
				@if (App::getLocale() != 'en')
				<th>{{ trans('models/bottle_size.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
				@endif
				<th class="text-right">{{ trans('models/bottle_size.attributes.capacity') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($bottle_sizes as $bottle_size)
			<tr>
				<td><a href="{{ action('BottleSizesController@edit', $bottle_size->id) }}">{{ $bottle_size->name }}</a></td>
				@if (App::getLocale() != 'en')
				<td>{{ $bottle_size->name_en }}</td>
				@endif
				<td class="text-right">{{ $bottle_size->capacity_formatted }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! $bottle_sizes->render() !!}
@endsection