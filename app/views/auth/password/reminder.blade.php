@extends('layouts.default')
@section('content')
<div class="container">
    <div class="page-header text-center">
        <h2>Forgot your password?</h2>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    {{ Former::framework('TwitterBootstrap3') }}
                    {{
                        Former::vertical_open()
                            ->rules(['email' => 'required'])
                            ->method('post')
                            ->route('password.remind');
                    }}

                    <p class="">Don't worry, it happens to all of us. Enter your email below and we'll send you instructions for setting a new password.</p>

                    {{ Former::email('email')->required() }}
                    {{ Former::large_primary_submit('Send instructions') }}
                {{ Former::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop