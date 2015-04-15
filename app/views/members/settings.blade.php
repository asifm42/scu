@extends('layouts.default')
@section('title', 'Black Settings')
@section('content')
<div class="container">
	<div class="page-header">
		<h1>Settings</h1>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">User profile</h3>
				</div>
				{{ Form::model($user, array('method' => 'PATCH', 'route' => ['users.update', $user->id])) }}

				<div class="panel-body">
					<div class="form-group">
						<label>Profile photo</label>
						<div class="well well-sm">
							<img class="gravatar" src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $user->email ) ) ) }}?s=62">
							<span class="text-muted">Photo loaded via Gravatar.</span>
							<a class="pull-right" href="https://gravatar.com/" target="_blank" tabindex="-1">Edit</a>
						</div>
					</div>
					<div class="form-group {{ ($errors->has('name') ? 'has-error' : '') }}">
						{{ Form::label('name', 'Name') }}
						{{ Form::text('name', null, array('class' => 'form-control')) }}
						{{ $errors->first('name', '<p class="text-danger">:message</p>')}}
					</div>
					<div class="form-group {{ ($errors->has('email') ? 'has-error' : '') }}">
						{{ Form::label('email', 'Email') }}
						{{ Form::email('email', null, array('class' => 'form-control')) }}
						{{ $errors->first('email', '<p class="text-danger">:message</p>')}}
					</div>
					<div class="form-group {{ ($errors->has('password') ? 'has-error' : '') }}">
						{{ Form::label('password', 'Password') }}
						{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'leave blank unless you want to change it')) }}
						{{ $errors->first('password', '<p class="text-danger">:message</p>')}}
					</div>
				</div>
				<div class="panel-footer">
					{{ Form::submit('Save', array('class' => 'btn btn-success')) }}
					<a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
				</div>

				{{ Form::close() }}
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Account information</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Account type</label>
						<div class="well well-sm">
							Free <a class="pull-right" href="#">Upgrade</a>
						</div>
					</div>
					<div class="form-group">
						<label>Storage usage <span class="text-muted">(50 of 250 MB)</span></label>
						<div class="progress">
							<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
								<span class="sr-only">20%</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop