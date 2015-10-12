<fieldset>
	<legend>
		{{ trans('sections.translations') }}
	</legend>
	<div class="panel-group" id="translations_accordion" role="tablist" aria-multiselectable="true">
		@if($model->exists)
		@foreach($model->translations as $translation)
		@if ($translation->locale !== App::getLocale())
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading_{{ $translation->locale }}" lang="{{ $translation->locale }}">
				<h4 class="panel-title">
					<i class="fa fa-circle"></i>
					<a role="button" data-toggle="collapse" data-parent="#translations_accordion" href="#translations_{{ $translation->locale }}" aria-expanded="true" aria-controls="collapseOne">
						{{ Punic\Language::getName($translation->locale, $translation->locale) }}
					</a>
				</h4>
			</div>
			<div id="translations_{{ $translation->locale }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{{ $translation->locale }}">
				<div class="panel-body">
					@foreach($model->translatedAttributes as $attribute)
					<div class="form-group{{ $errors->first('name', ' has-error') }}">
						<label for="name" class="col-md-4 col-sm-3 control-label">
							{{ trans('models/'.$modelName.'.attributes.'.$attribute, [], null, $translation->locale) }}
						</label>
						<div class="col-md-8 col-sm-7">
							{!! Form::text("{$translation->locale}[{$attribute}]", $translation->$attribute, ['class' => 'form-control input-sm', 'lang' => $translation->locale, 'placeholder' => trans('models/'.$modelName.'.attributes.name', [], null, $translation->locale)]) !!}
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		@endif
		@endforeach
		@foreach(array_diff(Config::get('translatable.locales'), $model->translations->pluck('locale')->toArray()) as $locale)
		@if ($locale !== App::getLocale())
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading_{{ $locale }}">
				<h4 class="panel-title">
					<i class="fa fa-circle-thin"></i>
					<a role="button" data-toggle="collapse" data-parent="#translations_accordion" href="#translations_{{ $locale }}" aria-expanded="true" aria-controls="collapseOne" lang="{{ $locale }}">
						{{ Punic\Language::getName($locale, $locale) }}
					</a>
				</h4>
			</div>
			<div id="translations_{{ $locale }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{{ $locale }}">
				<div class="panel-body">
					@foreach($model->translatedAttributes as $attribute)
					<div class="form-group{{ $errors->first('name', ' has-error') }}">
						<label for="name" class="col-md-4 col-sm-3 control-label">
							{{ trans('models/'.$modelName.'.attributes.'.$attribute, [], null, $locale) }}
						</label>
						<div class="col-md-8 col-sm-7">
							{!! Form::text("{$locale}[{$attribute}]", null, ['class' => 'form-control input-sm', 'lang' => $locale, 'placeholder' => trans('models/'.$modelName.'.attributes.name', [], null, $locale)]) !!}
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		@endif
		@endforeach
		@else
		@foreach(Config::get('translatable.locales') as $locale)
		@if ($locale !== App::getLocale())
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading_{{ $locale }}">
				<h4 class="panel-title">
					<i class="fa fa-circle-thin"></i>
					<a role="button" data-toggle="collapse" data-parent="#translations_accordion" href="#translations_{{ $locale }}" aria-expanded="true" aria-controls="collapseOne" lang="{{ $locale }}">
						{{ Punic\Language::getName($locale, $locale) }}
					</a>
				</h4>
			</div>
			<div id="translations_{{ $locale }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{{ $locale }}">
				<div class="panel-body">
					@foreach($model->translatedAttributes as $attribute)
					<div class="form-group{{ $errors->first('name', ' has-error') }}">
						<label for="name" class="col-md-4 col-sm-3 control-label">
							{{ trans('models/'.$modelName.'.attributes.'.$attribute, [], null, $locale) }}
						</label>
						<div class="col-md-8 col-sm-7">
							{!! Form::text("{$locale}[{$attribute}]", null, ['class' => 'form-control input-sm', 'lang' => $locale, 'placeholder' => trans('models/'.$modelName.'.attributes.name', [], null, $locale)]) !!}
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		@endif
		@endforeach
		@endif
	</div>
</fieldset>