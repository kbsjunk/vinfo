<div class="row">
    <div class="col-md-5">
        <fieldset>
            <legend>
                {{ trans('sections.details') }}
            </legend>

<div class="form-group{{ $errors->first('name', ' has-error') }}">
	<label for="name" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region_type.attributes.name') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region_type.attributes.name_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('models/region_type.attributes.name')]) !!}
		<span class="help-block">{{ $errors->first('name') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('description', ' has-error') }}">
	<label for="description" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region_type.attributes.description') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region_type.attributes.description_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('models/region_type.attributes.description'), 'rows' => 3]) !!}
		<span class="help-block">{{ $errors->first('description') }}</span>
	</div>
</div>
           
        </fieldset>
    </div>
<div class="col-md-7">
    @include('partials/translations', ['model'=>$region_type, 'modelName'=>'region_type'])
</div>
</div>