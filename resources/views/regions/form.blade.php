<div class="row">
    <div class="col-md-5">
        <fieldset>
            <legend>
                {{ trans('sections.details') }}
            </legend>

<div class="form-group{{ $errors->first('parent_id', ' has-error') }}">
	<label for="parent_id" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.parent_id') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.parent_id_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('parent_id', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.parent_id')]) !!}
		<span class="help-block">{{ $errors->first('parent_id') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('lft', ' has-error') }}">
	<label for="lft" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.lft') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.lft_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('lft', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.lft')]) !!}
		<span class="help-block">{{ $errors->first('lft') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('rgt', ' has-error') }}">
	<label for="rgt" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.rgt') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.rgt_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('rgt', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.rgt')]) !!}
		<span class="help-block">{{ $errors->first('rgt') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('depth', ' has-error') }}">
	<label for="depth" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.depth') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.depth_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('depth', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.depth')]) !!}
		<span class="help-block">{{ $errors->first('depth') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('country_id', ' has-error') }}">
	<label for="country_id" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.country_id') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.country_id_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('country_id', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.country_id')]) !!}
		<span class="help-block">{{ $errors->first('country_id') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('shortcut_id', ' has-error') }}">
	<label for="shortcut_id" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.shortcut_id') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.shortcut_id_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('shortcut_id', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.shortcut_id')]) !!}
		<span class="help-block">{{ $errors->first('shortcut_id') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('region_type_id', ' has-error') }}">
	<label for="region_type_id" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.region_type_id') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.region_type_id_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('region_type_id', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.region_type_id')]) !!}
		<span class="help-block">{{ $errors->first('region_type_id') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('is_structural', ' has-error') }}">
	<div class="col-md-offset-2 col-md-8 col-sm-offset-3 col-sm-7">
		<div class="checkbox">
			<label for="is_structural">
				{!! Form::hidden('is_structural', 0) !!}
				{!! Form::checkbox('is_structural') !!} {{ trans('models/region.attributes.is_structural') }}
				{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.is_structural_help') }}}"></i> --}}
			</label>
		</div>
		<span class="help-block">{{ $errors->first('is_structural') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('name', ' has-error') }}">
	<label for="name" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.name') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.name_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.name')]) !!}
		<span class="help-block">{{ $errors->first('name') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('description', ' has-error') }}">
	<label for="description" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/region.attributes.description') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.description_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.description')]) !!}
		<span class="help-block">{{ $errors->first('description') }}</span>
	</div>
</div>
           
        </fieldset>
    </div>
<div class="col-md-7">
    @include('partials/translations', ['model'=>$region, 'modelName'=>'region'])
</div>
</div>