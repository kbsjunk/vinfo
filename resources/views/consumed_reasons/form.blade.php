<div class="row">
    <div class="col-md-5">
        <fieldset>
            <legend>
                {{ trans('sections.details') }}
            </legend>

            <div class="form-group{{ $errors->first('name', ' has-error') }}">
                <label for="name" class="col-md-2 col-sm-3 control-label">
                    {{ trans('models/consumed_reason.attributes.name') }}
                    {{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/consumed_reason.attributes.name_help') }}}"></i> --}}
                </label>
                <div class="col-md-8 col-sm-7">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('models/consumed_reason.attributes.name')]) !!}
                    <span class="help-block">{{ $errors->first('name') }}</span>
                </div>
            </div>
            
            @if (App::getLocale() != 'en')
            <div class="form-group">
                <label for="name" class="col-md-4 col-sm-3 control-label">
                    {{ trans('models/consumed_reason.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})
                </label>
                <div class="col-md-8 col-sm-7">
                    <p class="form-control-static">{{ $consumed_reason->name_en }}</p>
                </div>
            </div>
            @endif

            <div class="form-group{{ $errors->first('is_drank', ' has-error') }}">
                <div class="col-md-offset-2 col-md-8 col-sm-offset-3 col-sm-7">
                    <div class="checkbox">
                        <label for="is_drank">
                            {!! Form::hidden('is_drank', 0) !!}
                            {!! Form::checkbox('is_drank') !!} {{ trans('models/consumed_reason.attributes.is_drank') }}
                            {{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/consumed_reason.attributes.is_drank_help') }}}"></i> --}}
                        </label>
                    </div>
                    <span class="help-block">{{ $errors->first('is_drank') }}</span>
                </div>
            </div>
			
			<div class="form-group{{ $errors->first('info', ' has-error') }}">
				<div class="col-md-12">
					
				<table class="table table-condensed table-form">
					<thead>
						<tr>
							<th>Label</th>
							<th>Type</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($consumed_reason->info_fields as $key => $field)
						<tr>
							<td>{!! Form::text('info_field_names[]', $field['label'], ['class'=>'form-control input-sm']) !!}</td>
							<td>{!! Form::select('info_field_types[]', ['text','money','currency','country','rating'], $field['type'], ['class'=>'form-control input-sm'])!!}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				</div>
			</div>

        </fieldset>
    </div>
    <div class="col-md-7">
        @include('partials/translations', ['model'=>$consumed_reason, 'modelName'=>'consumed_reason'])
    </div>
</div>