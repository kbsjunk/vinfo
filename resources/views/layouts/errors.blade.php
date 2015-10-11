<div class="row">
	<div class="col-md-8 col-md-offset-2">
		@if (count($errors) > 0)
		<div id="alert" class="alert alert-danger fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" data-target="#alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="media">
				<div class="media-left media-top">
					<strong class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="padding:0 15px;"></strong>
				</div>
				<div class="media-body">
					<h4 class="media-heading">{{ trans('messages.error') }}</h4>
					{{ trans('messages.saved_error') }}
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		@elseif (session('error'))
		<div id="alert" class="alert alert-danger fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" data-target="#alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="media">
				<div class="media-left media-top">
					<strong class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="padding:0 15px;"></strong>
				</div>
				<div class="media-body">
					<h4 class="media-heading">{{ trans('messages.error') }}</h4>
					{{ session('error') }}
				</div>
			</div>
		</div>
		@elseif (session('success'))
		<div id="alert" class="alert alert-success fade in" role="alert">
			<div class="media">
				<button type="button" class="close" data-dismiss="alert" data-target="#alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="media-left media-top">
					<strong class="fa fa-check-circle fa-3x" aria-hidden="true" style="padding:0 15px;"></strong>
				</div>
				<div class="media-body">
					<h4 class="media-heading">{{ trans('messages.success') }}</h4>
					{{ session('success') }}
					@if (session('successes'))
					<ul>
						@foreach (session('successes') as $success)
						<li>{{ $success }}</li>
						@endforeach
					</ul>
					@endif
				</div>
			</div>	
		</div>
		@endif
	</div>
</div>