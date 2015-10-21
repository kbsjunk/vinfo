@extends('layouts/default')

@section('title', trans('sections.region_types'))

@section('content')
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table">
		<thead>
			<tr>
				<th>{{ trans('models/region_type.attributes.name') }}</th>
				<th>{{ trans('models/region_type.attributes.description') }}</th>
				@if (App::getLocale() != 'en')
					<th>{{ trans('models/region_types.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($region_types as $region_type)
			<tr>
				<td><a href="{{ action('RegionTypesController@edit', $region_type->id) }}">{{ $region_type->name }}</a></td>
				<td>{{ $region_type->description }}</td>
				@if (App::getLocale() != 'en')
					<td>{{ $region_type->name_en }}</td>
				@endif
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
	<div class="panel-footer">
		{!! $region_types->render() !!}
	</div>
</div>
@endsection