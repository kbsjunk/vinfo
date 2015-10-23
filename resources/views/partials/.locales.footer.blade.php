<footer class="footer">
	<div class="container">
		@if(Auth::check())
		<div class="pull-right">
			<div class="dropup">
				<button class="btn btn-link btn-sm dropdown-toggle" type="button" id="language-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">{{ trans('actions.language') }}: </span>
					{{ Auth::user()->language->name }}
					&nbsp;
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="language-menu">
					@foreach (get_locales() as $code)
					<li lang="{{ $code }}"><a href="{{ action('UsersController@setLanguage', $code) }}">{{ Punic\Language::getName($code, $code) }}</a></li>
					@endforeach
					<li class="divider"></li>
					<li><a href="{{ action('\Barryvdh\TranslationManager\Controller@getIndex') }}">{{ trans('sections.translations') }} &nbsp; <i class="fa fw fa-globe"></i></a></li>
				</ul>
			</div>
		</div>
		@endif
		<p class="text-muted">&copy; Vinfo 2015</p>
	</div>
</footer>