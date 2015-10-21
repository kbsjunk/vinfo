@parent
@can('destroy', $model)
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('actions.close') }}"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="delete-modal-label">{{ trans('actions.delete') }}</h4>
			</div>
			<div class="modal-body">
				{{ trans('messages.confirm_delete') }}
			</div>
			<div class="modal-footer">
				{!! Form::model($model, ['action' => [$controller.'@destroy', $model->id], 'method' => 'DELETE']) !!}
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('actions.cancel') }}</button>
				<button type="submit" class="btn btn-danger">{{ trans('actions.delete') }}</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endcan