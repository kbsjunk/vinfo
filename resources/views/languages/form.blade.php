
<div class="form-group{{ $errors->first('code', ' has-error') }}">
	<label for="code" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/language.attributes.code') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/language.attributes.code_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => trans('models/language.attributes.code'), 'id' => 'code']) !!}
		<span class="help-block">{{ $errors->first('code') }}</span>
	</div>
</div>

<div class="form-group{{ $errors->first('name', ' has-error') }}">
	<label for="name" class="col-md-2 col-sm-3 control-label">
		{{ trans('models/language.attributes.name') }}
		{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/language.attributes.name_help') }}}"></i> --}}
	</label>
	<div class="col-md-8 col-sm-7">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('models/language.attributes.name'), 'id' => 'name']) !!}
		<span class="help-block">{{ $errors->first('name') }}</span>
	</div>
</div>

@section('scripts')
<script src="{{ asset('js/languages.js') }}"></script>
@endsection
