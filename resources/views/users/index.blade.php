@extends('layouts/default')

@section('title', trans('sections.users'))

@section('content')
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table table-valign-middle">
			<thead>
				<tr>
					<th class="col-md-3">{{ trans('models/user.attributes.name') }}</th>
					<th class="col-md-2">{{ trans('models/user.attributes.email') }}</th>
					<th class="col-md-2">{{ trans('models/user.attributes.country_id') }}</th>
					<th class="col-md-2">{{ trans('models/user.attributes.language_id') }}</th>
					<th class="col-md-2">{{ trans('models/user.attributes.currency_id') }}</th>
					<th class="col-md-1">{{ trans('models/user.attributes.is_admin') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>
						<a href="{{ action('UsersController@edit', $user->id) }}">
							<div class="media">
								<div class="media-left media-middle">
									<img src="{{ asset('img/user.png') }}" class="img-circle img-avatar-sm media-object">
								</div>
								<div class="media-body media-middle">
									{{ $user->name }}
								</div>
							</div>
						</a>
					</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->country->name }}</td>
					<td>{{ $user->language->name_local }}</td>
					<td>{{ $user->currency->name }}</td>
					<td>{{ $user->is_admin ? trans('messages.yes') : trans('messages.no') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		{!! $users->render() !!}
	</div>
</div>
@endsection