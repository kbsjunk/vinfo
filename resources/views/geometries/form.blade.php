<div class="row">

	<div class="col-md-6">
		<fieldset>
			<legend>
				{{ trans('sections.details') }}
			</legend>

			<div class="form-group{{ $errors->first('name', ' has-error') }}">
				<label for="name" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/geometry.attributes.name') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('models/geometry.attributes.name')]) !!}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('description', ' has-error') }}">
				<label for="description" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/geometry.attributes.description') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::textarea('description', null, ['class' => 'form-control input-sm', 'placeholder' => trans('models/geometry.attributes.description'), 'rows' => 6]) !!}
					<span class="help-block">{{ $errors->first('description') }}</span>
				</div>
			</div>


			<div class="form-group{{ $errors->first('quality', ' has-error') }}">
				<label for="quality" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/geometry.attributes.quality') }}
				</label>
				<div class="col-md-2 col-sm-3">
					{!! Form::number('quality', null, ['class' => 'form-control', 'placeholder' => trans('models/geometry.attributes.quality')]) !!}
					<span class="help-block">{{ $errors->first('quality') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('shape', ' has-error') }}">
				<label for="shape" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/geometry.attributes.shape') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::select('shape', $shapes, null, ['class' => 'form-control', 'data-selectize' => 'single']) !!}
					<span class="help-block">{{ $errors->first('shape') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('format', ' has-error') }}">
				<label for="format" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/geometry.attributes.format') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::select('format', $formats, null, ['class' => 'form-control', 'data-selectize' => 'single']) !!}
					<span class="help-block">{{ $errors->first('format') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('source', ' has-error') }}">
				<label for="source" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/geometry.attributes.source') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::textarea('source', null, ['class' => 'form-control input-sm', 'placeholder' => trans('models/geometry.attributes.source'), 'rows' => 4]) !!}
					<span class="help-block">{{ $errors->first('source') }}</span>
				</div>
			</div>

		</fieldset>

		<fieldset>

			<legend>
				{{ trans('models/geometry.attributes.related_record') }}
			</legend>

			<div class="form-group{{ $errors->first('geometried_type', ' has-error') }}">
				<label for="geometried_type" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/geometry.attributes.related_record_type') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::select('geometried_type', $relatedRecords, null, ['class' => 'form-control', 'placeholder' => trans('models/geometry.attributes.geometried_type'), 'data-selectize'=>'geometried_type']) !!}
					<span class="help-block">{{ $errors->first('geometried_type') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('geometried_id', ' has-error') }}">
				<label for="geometried_id" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/geometry.attributes.related_record_name') }}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('geometried_id', null, ['class' => 'form-control', 'placeholder' => trans('models/geometry.attributes.geometried_id'), 'data-selectize' => 'geometried_id' ]) !!}
					<span class="help-block">{{ $errors->first('geometried_id') }}</span>
				</div>
			</div>



		</fieldset>
	</div>
	<div class="col-md-6">

		<fieldset>
			<legend>{{ trans('models/geometry.attributes.geometry') }}</legend>


			<div class="form-group{{ $errors->first('geometry', ' has-error') }}">
				<label for="geometry" class="sr-only">
					{{ trans('models/geometry.attributes.geometry') }}
				</label>
				<div class="col-sm-12">
					{!! Form::textarea('geometry_json', null, ['class' => 'form-control plaintext', 'placeholder' => trans('models/geometry.attributes.geometry')]) !!}
					<span class="help-block">{{ $errors->first('geometry') }}</span>
				</div>
			</div>

		</fieldset>

		<fieldset>

			<legend>
				{{ trans('models/geometry.attributes.properties') }}
			</legend>

			<div class="form-group{{ $errors->first('properties', ' has-error') }}">
				<div class="col-md-12">

					<table class="table table-condensed table-form" data-addrow-table>
						<thead>
							<tr>
								<th class="col-md-3">Key</th>
								<th class="col-md-9">Value</th>
								<th width="20">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach (old('properties', $geometry->properties) as $key => $field)
							<tr>
								<td>{!! Form::text('property_keys[]', $key, ['class'=>'form-control input-sm','placeholder'=>'Key']) !!}</td>
								<td>{!! Form::text('property_names[]', $field, ['class'=>'form-control input-sm','placeholder'=>'Label']) !!}</td>
								<td class="has-btn">
									<button type="button" class="btn btn-link btn-sm" data-addrow-delete>
										<i class="fa fa-trash"></i>
									</button>
								</td>
							</tr>
							@endforeach
							<tr style="display:none;" data-addrow-template="properties">
								<td>{!! Form::text('property_keys[]', null, ['class'=>'form-control input-sm','placeholder'=>'Key']) !!}</td>
								<td>{!! Form::text('property_names[]', null, ['class'=>'form-control input-sm','placeholder'=>'Label']) !!}</td>
								<td class="has-btn">
									<button type="button" class="btn btn-link btn-sm" data-addrow-delete>
										<i class="fa fa-trash"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
					<button type="button" class="btn btn-default btn-sm" data-addrow="properties">
						Add property
					</button>
				</div>
			</div>

		</fieldset>

	</div>

</div>


@section('scripts')
@parent
<script src="{{ asset('js/addrow.js') }}" type="text/javascript"></script>
<script>

	$('[data-selectize="geometried_type"]').selectize({
		create: false,
		onChange: function(value) {
			var selectize = $('[data-selectize="geometried_id"]').selectize()[0].selectize;
			selectize.clearOptions();
			if (!value) {
				selectize.setValue(null);
			}
		}
	});



	$('[data-selectize="geometried_id"]').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: 'name',
		maxItems: 1,
		options: [{!! old('geometried_select', $geometry->geometried_select) !!}],
		render: {
			option: function(item, escape) {
				console.log(item);
				return '<div class="option">' +
				escape(item.name) + ' <span class="text-muted">'+ escape(item.subname) +'</span>' +
				'</div>';
			},
			item: function (item, escape) {
				return '<div class="item">' +
				escape(item.name) + ' <small class="text-muted">'+ escape(item.subname) +'</small>' +
				'</div>';
			}
		},
		load: function(query, callback) {
			if (!query.length) return callback();
			$.ajax({
				url: base_url('api/admin/geometries/related/search'),
				data: {
					query: query,
					geometried_type: $('[data-selectize="geometried_type"]').selectize()[0].selectize.getValue()
				},
				type: 'POST',
				error: function() {
					callback();
				},
				success: function(data) {
					callback(data.data);
				}
			});
		}
	});
</script>
@endsection