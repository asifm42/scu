@extends('layouts.default')
@section('title','Sign up')
@section('content')
<div class="container">
	<div class="page-header">
		<h1>Sign up</h1>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-trace-paper">
				<div class="panel-heading">
					<h3 class="panel-title">Create a new account</h3>
				</div>
				<div class="panel-body">
				@if (Config::get('scu.disablesignup') == true)
					<span class="text-muted">Accout creation has been disabled by the administrator.</span>
				@else
				{{ Former::framework('TwitterBootstrap3') }}
				{{
	                Former::vertical_open()
	                    ->route('members.store');
	            }}
	            {{
	                Former::text('name')
	                    ->class('form-control')
	                    ->required();
	            }}
	            {{
	                Former::text('nickname')
	                    ->class('form-control');
	            }}
	            {{
	                Former::email('email')
	                    ->class('form-control')
	                    ->required();
	            }}
	            {{
	                Former::password('password')
	                    ->class('form-control')
	                    ->required();
	            }}
	            {{
	                Former::password('confirm_password')
	                    ->class('form-control')
	                    ->required();
	            }}

				{{ Form::submit('Sign up', array('class' => 'btn btn-success')) }}
				{{ Former::close() }}
				@endif

				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('scripts')
	<script src='https://www.google.com/recaptcha/api.js'></script>
@stop