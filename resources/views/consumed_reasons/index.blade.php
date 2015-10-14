@extends('layouts/default')

@section('title', trans('sections.consumed_reasons'))

@section('content')
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table">
		<thead>
			<tr>
				<th>{{ trans('models/consumed_reason.attributes.name') }}</th>
				@if (App::getLocale() != 'en')
					<th>{{ trans('models/consumed_reasons.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
				@endif
				<th>{{ trans('models/consumed_reason.attributes.info') }}</th>
				<th>{{ trans('models/consumed_reason.attributes.is_drank') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($consumed_reasons as $consumed_reason)
			<tr>
				<td><a href="{{ action('ConsumedReasonsController@edit', $consumed_reason->id) }}">{{ $consumed_reason->name }}</a></td>
				@if (App::getLocale() != 'en')
					<td>{{ $consumed_reason->name_en }}</td>
				@endif
				<td>{{ implode(', ', $consumed_reason->info_labels) }}</td>
				<td>{{ $consumed_reason->is_drank }}</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
	<div class="panel-footer">
		{!! $consumed_reasons->render() !!}
	</div>
</div>
@endsection