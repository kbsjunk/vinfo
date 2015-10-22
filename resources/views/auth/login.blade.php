@extends('layouts/default')

@section('title', trans('actions.login'))

@section('content')

<form method="POST" action="{{ url('auth/login') }}" class="form-horizontal">
	{!! csrf_field() !!}
	<div class="panel panel-default">
		<div class="panel-body">
			<fieldset>
				<legend>
					{{ trans('actions.login') }}
				</legend>
				<div class="form-group{{ $errors->first('email', ' has-error') }}">
					<label for="email" class="col-md-4 col-sm-3 control-label">
						{{ trans('models/user.attributes.email') }}
					</label>
					<div class="col-md-5 col-sm-7">
						{!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.email')]) !!}
						<span class="help-block">{{ $errors->first('email') }}</span>
					</div>
				</div>
				
				<div class="form-group{{ $errors->first('password', ' has-error') }}">
					<label for="password" class="col-md-4 col-sm-3 control-label">
						{{ trans('models/user.attributes.password') }}
					</label>
					<div class="col-md-5 col-sm-7">
						{!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.password')]) !!}
						<span class="help-block">{{ $errors->first('password') }}</span>
					</div>
				</div>
				
				<div class="form-group{{ $errors->first('remember', ' has-error') }}">
					<div class="col-md-offset-4 col-md-8 col-sm-offset-3 col-sm-9">
						<div class="checkbox">
							<label for="remember">
								{!! Form::hidden('remember', 0) !!}
								{!! Form::checkbox('remember') !!} {{ trans('models/user.attributes.remember_token') }}
							</label>
						</div>
						<span class="help-block">{{ $errors->first('remember') }}</span>
					</div>
				</div>
			</fieldset>
		</div> <!-- .panel-body -->
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-offset-3 col-sm-9 col-md-offset-4 col-md-8">
					<button type="submit" class="btn btn-primary">{{ trans('actions.login') }}</button>
				</div>
			</div>
		</div> <!-- .panel-footer -->
	</div> <!-- .panel -->
</form>
@endsection