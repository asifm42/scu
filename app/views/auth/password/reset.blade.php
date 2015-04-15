@extends('layouts.default')
@section('content')
<div class="container">
    <div class="page-header text-center">
        <h2>Change your password</h2>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-trace-paper">
                <div class="panel-body">
                {{ Former::framework('TwitterBootstrap3') }}
                {{
                    Former::vertical_open()
                        ->rules(['email' => 'required'])
                        ->method('post')
                        ->route('password.reset');
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

                {{ Former::hidden('token', $token) }}
                {{ Former::large_primary_submit('Save') }}
                {{ Former::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop