<!-- resources/views/auth/register.blade.php -->

@extends('layouts/default')

@section('title', trans('actions.register'))

@section('content')

<form method="POST" action="{{ url('auth/register') }}" class="form-horizontal">
	{!! csrf_field() !!}
	<div class="panel panel-default">
		<div class="panel-body">
			<fieldset>
				<legend>
					{{ trans('actions.register') }}
				</legend>
				<div class="form-group{{ $errors->first('name', ' has-error') }}">
					<label for="name" class="col-md-4 col-sm-3 control-label">
						{{ trans('models/user.attributes.name') }}
					</label>
					<div class="col-md-5 col-sm-7">
						{!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.name')]) !!}
						<span class="help-block">{{ $errors->first('name') }}</span>
					</div>
				</div>

				<div class="form-group{{ $errors->first('email', ' has-error') }}">
					<label for="email" class="col-md-4 col-sm-3 control-label">
						{{ trans('models/user.attributes.email') }}
					</label>
					<div class="col-md-5 col-sm-7">
						{!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.email')]) !!}
						<span class="help-block">{{ $errors->first('email') }}</span>
					</div>
				</div>
				
				{{--<div class="form-group{{ $errors->first('email_confirmation', ' has-error') }}">
					<label for="email_confirmation" class="col-md-4 col-sm-3 control-label">
						{{ trans('models/user.attributes.email_confirmation') }}
					</label>
					<div class="col-md-5 col-sm-7">
						{!! Form::email('email_confirmation', old('email_confirmation'), ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.email_confirmation')]) !!}
						<span class="help-block">{{ $errors->first('email_confirmation') }}</span>
					</div>
				</div>--}}

				<div class="form-group{{ $errors->first('password', ' has-error') }}">
					<label for="password" class="col-md-4 col-sm-3 control-label">
						{{ trans('models/user.attributes.password') }}
					</label>
					<div class="col-md-5 col-sm-7">
						{!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.password')]) !!}
						<span class="help-block">{{ $errors->first('password') }}</span>
					</div>
				</div>

				<div class="form-group{{ $errors->first('password_confirmation', ' has-error') }}">
					<label for="password_confirmation" class="col-md-4 col-sm-3 control-label">
						{{ trans('models/user.attributes.password_confirmation') }}
					</label>
					<div class="col-md-5 col-sm-7">
						{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('models/user.attributes.password_confirmation')]) !!}
						<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
					</div>
				</div>
			</fieldset>
		</div> <!-- .panel-body -->
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-offset-3 col-sm-9 col-md-offset-4 col-md-8">
					<button type="submit" class="btn btn-primary">{{ trans('actions.register') }}</button>
				</div>
			</div>
		</div> <!-- .panel-footer -->
	</div> <!-- .panel -->
</form>
@endsection