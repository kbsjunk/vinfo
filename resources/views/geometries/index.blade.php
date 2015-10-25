@extends('layouts/default')

@section('title', trans('sections.geometries'))

@section('content')
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table">
		<thead>
			<tr>
				<th rowspan="2">{{ trans('models/geometry.attributes.name') }}</th>
				<th rowspan="2">{{ trans('models/geometry.attributes.shape') }}</th>
				<th rowspan="2">{{ trans('models/geometry.attributes.format') }}</th>
				<th rowspan="2">{{ trans('models/geometry.attributes.quality') }}</th>
				<th rowspan="2">{{ trans('models/geometry.attributes.source') }}</th>
				<th colspan="2">{{ trans('models/geometry.attributes.related_record') }}</th>
			</tr>
			<tr>
				<th>{{ trans('models/geometry.attributes.related_record_name') }}</th>
				<th>{{ trans('models/geometry.attributes.related_record_type') }}</th>

			</tr>
		</thead>
		<tbody>
			@foreach($geometries as $geometry)
			<tr>
				<td><a href="{{ action('GeometriesController@edit', $geometry->id) }}">{{ $geometry->name }}</a></td>
				<td>{{ $geometry->shape }}</td>
				<td>{{ $geometry->format }}</td>
				<td>{{ $geometry->quality }}</td>
				<td>{{ $geometry->source }}</td>
				<td>{{ @$geometry->geometried->name }}</td>
				<td>{{ $geometry->geometried_type }}</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
	<div class="panel-footer">
		{!! $geometries->render() !!}
	</div>
</div>
@endsection