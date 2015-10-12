<div class="row">
	<div class="col-md-5">
		<fieldset>
			<legend>
				{{ trans('sections.details') }}
			</legend>

			<div class="form-group{{ $errors->first('capacity', ' has-error') }}">
				<label for="capacity" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/bottle_size.attributes.capacity') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('capacity', null, ['class' => 'form-control', 'placeholder' => trans('models/bottle_size.attributes.capacity')]) !!}
					<span class="help-block">{{ $errors->first('capacity') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('name', ' has-error') }}">
				<label for="name" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/bottle_size.attributes.name') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('models/bottle_size.attributes.name')]) !!}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
			</div>

			@if (App::getLocale() != 'en')
			<div class="form-group{{ $errors->first('name', ' has-error') }}">
				<label for="name" class="col-md-4 col-sm-3 control-label">
					{{ trans('models/bottle_size.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})
				</label>
				<div class="col-md-8 col-sm-7">
					<p class="form-control-static">{{ $bottle_size->name_en }}</p>
				</div>
			</div>
			@endif

			<div class="form-group{{ $errors->first('is_common', ' has-error') }}">
				<div class="col-md-offset-2 col-md-8 col-sm-offset-3 col-sm-7">
					<div class="checkbox">
						<label for="is_common">
							{!! Form::hidden('is_common', 0) !!}
							{!! Form::checkbox('is_common') !!} {{ trans('models/bottle_size.attributes.is_common') }}
						</label>
					</div>
					<span class="help-block">{{ $errors->first('is_common') }}</span>
				</div>
			</div>

		</fieldset>
	</div>

	<div class="col-md-7">
		@include('partials/translations', ['model'=>$bottle_size, 'modelName'=>'bottle_size'])
	</div>
</div>