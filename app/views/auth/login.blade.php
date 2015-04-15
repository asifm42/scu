@extends('layouts.default')
@section('title','Sign in')
@section('content')
<div class="container">
	<div class="page-header">
		<h1>Sign in</h1>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-trace-paper">
				<div class="panel-heading">
					<h3 class="panel-title">Access an existing account</h3>
				</div>
				<div class="panel-body">
				{{ Form::open(array('route' => 'sessions.signin')) }}
					<div class="form-group {{ ($errors->has('email') ? 'has-error' : '') }}">
						{{ Form::label('email', 'Email') }}
						{{ Form::email('email', null, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => '')) }}
						{{ $errors->first('email', '<p class="text-danger">:message</span>') }}
					</div>
					<div class="form-group {{ ($errors->has('password') ? 'has-error' : '') }}">
						{{ Form::label('password', 'Password') }}
						{{ Form::password('password', array('class' => 'form-control')) }}
						{{ $errors->first('password', '<p class="text-danger">:message</span>')}}
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="checkbox">
								<label>{{ Form::checkbox('remember_me', 'true') }} Remember me</label>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="checkbox pull-right">
								<a href="{{ url('password/reminder')}}">Forgot password?</a>
							</div>
						</div>
					</div>
					{{ Form::submit('Sign in', array('class' => 'btn btn-success')) }}
					<span class="text-muted">or</span>
					<a href="{{ route('members.register')}}" class="btn btn-primary" role="button">Sign up</a>
				{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@stop