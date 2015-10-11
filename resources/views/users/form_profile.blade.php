
<div class="row">
	<div class="col-md-6">
		<fieldset>
			<legend>{{ trans('sections.account') }}</legend>
			<div class="form-group{{ $errors->first('name', ' has-error') }}">
				<label for="name" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/user.attributes.name') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.name')]) !!}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
			</div>
			<div class="form-group{{ $errors->first('email', ' has-error') }}">
				<label for="email" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/user.attributes.email') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.email')]) !!}
					<span class="help-block">{{ $errors->first('email') }}</span>
				</div>
			</div>
			<div class="form-group{{ $errors->first('password', ' has-error') }}">
				<label for="password" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/user.attributes.password') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.password')]) !!}
					<span class="help-block">{{ $errors->first('password') }}</span>
				</div>
			</div>
			<div class="form-group{{ $errors->first('password_confirmation', ' has-error') }}" class="col-md-6">
				<label for="password_confirmation" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/user.attributes.password_confirmation') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.password_confirmation')]) !!}
					<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="col-md-6">
		<fieldset>
			<legend>{{ trans('sections.settings') }}</legend>
			<div class="form-group{{ $errors->first('country_id', ' has-error') }}">
				<label for="country_id" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/user.attributes.country_id') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::select('country_id', $countries, null, ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.country_id'), 'data-selectize' => 'single']) !!}
					<span class="help-block">{{ $errors->first('country_id') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('language_id', ' has-error') }}">
				<label for="language_id" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/user.attributes.language_id') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::select('language_id', $languages, null, ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.language_id'), 'data-selectize' => 'single']) !!}
					<span class="help-block">{{ $errors->first('language_id') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('currency_id', ' has-error') }}">
				<label for="currency_id" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/user.attributes.currency_id') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::select('currency_id', $currencies, null, ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.currency_id'), 'data-selectize' => 'single']) !!}
					<span class="help-block">{{ $errors->first('currency_id') }}</span>
				</div>
			</div>
		</fieldset>
	</div>
</div>