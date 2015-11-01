<div class="row">
	<div class="col-md-5">
		<fieldset>
			<legend>
				{{ trans('sections.details') }}
			</legend>

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

			<div class="form-group{{ $errors->first('region_type_id', ' has-error') }}">
				<label for="region_type_id" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/region.attributes.region_type_id') }}
					{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.region_type_id_help') }}}"></i> --}}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::select('region_type_id', $region_types, null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.region_type_id'), 'data-selectize' => 'single']) !!}
					<span class="help-block">{{ $errors->first('region_type_id') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('description', ' has-error') }}">
				<label for="description" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/region.attributes.description') }}
					{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.description_help') }}}"></i> --}}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.description'), 'rows' => 3]) !!}
					<span class="help-block">{{ $errors->first('description') }}</span>
				</div>
			</div>

		</fieldset>
		<fieldset>
			<legend>
				{{ trans('tree.tree') }}
			</legend>

			<div class="form-group{{ $errors->first('country_id', ' has-error') }}">
				<label for="country_id" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/region.attributes.country_id') }}
					{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.country_id_help') }}}"></i> --}}
				</label>
				<div class="col-md-8 col-sm-7">
					@if ($region->exists)
					<p class="form-control-static">{{ $region->country->name }}</p>
					@else
					{!! Form::select('country_id', $countries, null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.country_id'), 'data-selectize' => 'single']) !!}
					@endif
					<span class="help-block">{{ $errors->first('country_id') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('parent_id', ' has-error') }}">
				<label for="parent_id" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/region.attributes.parent_id') }}
					{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.parent_id_help') }}}"></i> --}}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('parent_id', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.parent_id'), 'data-selectize' => 'region_strict']) !!}
					<span class="help-block">{{ $errors->first('parent_id') }}</span>
				</div>
			</div>

			<div class="form-group{{ $errors->first('shortcut_id', ' has-error') }}">
				<label for="shortcut_id" class="col-md-2 col-sm-3 control-label">
					{{ trans('models/region.attributes.shortcut_id') }}
					{{-- <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('models/region.attributes.shortcut_id_help') }}}"></i> --}}
				</label>
				<div class="col-md-8 col-sm-7">
					{!! Form::text('shortcut_id', null, ['class' => 'form-control', 'placeholder' => trans('models/region.attributes.shortcut_id'), 'data-selectize' => 'region_strict']) !!}
					<span class="help-block">{{ $errors->first('shortcut_id') }}</span>
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

		</fieldset>
	</div>
	<div class="col-md-7">
		@include('partials/translations', ['model'=>$region, 'modelName'=>'region'])
	</div>
</div>


@section('scripts')
@parent
<script>
	$('[data-selectize="region_strict"]').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: 'name',
		maxItems: 1,
		options: $(this).prop('name') == 'parent_id' ? [{!! old('parent_id_select', $region->parent_id_select) !!}] : [{!! old('shortcut_id_select', $region->shortcut_id_select) !!}],
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
				url: base_url('api/admin/regions/tree/search/{{ $region ? $region->id : null }}'),
				data: {
					query: query,
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