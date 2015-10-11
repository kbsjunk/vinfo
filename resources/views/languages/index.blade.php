@extends('layouts/default')

@section('title', trans('sections.languages'))

@section('content')
<div class="table-responsive">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th class="col-sm-1">{{ trans('models/language.attributes.code') }}</th>
				<th>{{ trans('models/language.attributes.name') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($languages as $language)
			<tr>
				<td>{{ $language->code }}</td>
				<td><a href="{{ action('LanguagesController@edit', $language->id) }}">{{ $language->name }}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! $languages->render() !!}
@endsection