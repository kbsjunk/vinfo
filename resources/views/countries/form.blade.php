<div class="row">
	<div class="col-md-5">
		<fieldset>
			<legend>
				{{ trans('sections.details') }}
			</legend>
			<div class="form-group{{ $errors->first('code', ' has-error') }}">
				<label for="code" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/country.attributes.code') }}
					{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/country.attributes.code_help') }}}"></i> --}}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => trans('models/country.attributes.code')]) !!}
					<span class="help-block">{{ $errors->first('code') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('name', ' has-error') }}">
				<label for="name" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/country.attributes.name') }}
					{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/country.attributes.name_help') }}}"></i> --}}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('models/country.attributes.name')]) !!}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
			</div>

			@if (App::getLocale() != 'en')
			<div class="form-group">
				<label for="name" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/country.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})
				</label>
				<div class="col-md-8 col-sm-7">
					<p class="form-control-static">{{ $country->name_en }}</p>
				</div>
			</div>
			@endif
		</fieldset>
	</div>
	<div class="col-md-7">
	@include('partials/translations', ['model'=>$country, 'modelName'=>'country'])
	</div>
</div>