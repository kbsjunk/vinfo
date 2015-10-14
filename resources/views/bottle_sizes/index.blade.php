@extends('layouts/default')

@section('title', trans('sections.bottle_sizes'))

@section('content')
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="text-right col-md-1">{{ trans('models/bottle_size.attributes.capacity') }}</th>
					<th>{{ trans('models/bottle_size.attributes.name') }}</th>
					@if (App::getLocale() != 'en')
					<th>{{ trans('models/bottle_size.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
					@endif
					<th class="col-md-1">{{ trans('models/bottle_size.attributes.is_common') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($bottle_sizes as $bottle_size)
				<tr>
					<td class="text-right">{{ $bottle_size->capacity_formatted }}</td>
					<td><a href="{{ action('BottleSizesController@edit', $bottle_size->id) }}">{{ $bottle_size->name }}</a></td>
					@if (App::getLocale() != 'en')
					<td>{{ $bottle_size->name_en }}</td>
					@endif
					<td>{{ $bottle_size->is_common ? trans('messages.yes') : trans('messages.no') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		{!! $bottle_sizes->render() !!}
	</div>
</div>
@endsection