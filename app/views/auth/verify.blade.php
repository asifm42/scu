@extends('layouts.default')

@section('content')

<div class="container">
    <div class="page-header text-center">
        <h2>Resend Verification Email</h2>
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
                        ->route('members.resetVerify');
                }}

                {{ Former::email('email')->required() }}

                {{ Former::large_primary_submit('Resend') }}
                {{ Former::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
