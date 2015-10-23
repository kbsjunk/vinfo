@extends('layouts/default')

@section('title', trans('sections.regions'))

@section('content')
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>{{ trans('models/region.attributes.name') }}</th>
					@if (App::getLocale() != 'en')
					<th>{{ trans('models/regions.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
					@endif
					<th>{{ trans('models/region.attributes.region_type_id') }}</th>
					<th>{{ trans('models/region.attributes.country_id') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($regions as $i => $region)
				@if ($i == 0 && $region->depth > 0)
				@foreach ($region->ancestors()->with('country', 'regionType')->get() as $ancestor)
				<tr>
					<td>
						<span style="margin-left:{{ $ancestor->depth * 20 }}px;margin-right:5px;">
							@if (!$ancestor->isLeaf())
							<button type="button" class="btn btn-xs btn-link"><u class="caret"></u></button>
							@else
							<span style="margin-left:20px;"></span>
							@endif
						</span>
						@if ($ancestor->shortcut_id)
						<a href="{{ action('RegionsController@edit', $ancestor->id) }}">{{ $ancestor->name }}</a> ({{ trans('tree.continued') }})
						<a href="{{ action('RegionsController@edit', $ancestor->shortcut_id) }}" class="btn btn-xs btn-link"><i class="fa fa-share"></i></a>
						@else
						@if ($ancestor->region_type_id == 1)
						<a href="{{ action('RegionsController@edit', $ancestor->id) }}"><strong>{{ $ancestor->name }}</strong></a>  ({{ trans('tree.continued') }})
						@else
						<a href="{{ action('RegionsController@edit', $ancestor->id) }}">{{ $ancestor->name }}</a> ({{ trans('tree.continued') }})
						@endif
						@endif
					</td>
					@if (App::getLocale() != 'en')
					<td>{{ $ancestor->name_en }}</td>
					@endif
					<td>{{ $ancestor->regionType->name }}</td>
					<td>{{ $ancestor->country->name }}</td>
				</tr>
				@endforeach
				@endif
				<tr>
					<td>
						<span style="margin-left:{{ $region->depth * 20 }}px;margin-right:5px;">
							@if (!$region->isLeaf())
							<button type="button" class="btn btn-xs btn-link"><u class="caret"></u></button>
							@else
							<span style="margin-left:20px;"></span>
							@endif
						</span>
						@if ($region->shortcut_id)
						<a href="{{ action('RegionsController@edit', $region->id) }}">{{ $region->name }}</a> 
						<a href="{{ action('RegionsController@edit', $region->shortcut_id) }}" class="btn btn-xs btn-link"><i class="fa fa-share"></i></a>
						@else
						@if ($region->region_type_id == 1)
						<a href="{{ action('RegionsController@edit', $region->id) }}"><strong>{{ $region->name }}</strong></a>
						@else
						<a href="{{ action('RegionsController@edit', $region->id) }}">{{ $region->name }}</a>
						@endif
						@endif
					</td>
					@if (App::getLocale() != 'en')
					<td>{{ $region->name_en }}</td>
					@endif
					<td>{{ $region->regionType->name }}</td>
					<td>{{ $region->country->name }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		{!! $regions->render() !!}
	</div>
</div>
@endsection