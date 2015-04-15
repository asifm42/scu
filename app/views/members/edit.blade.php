@extends('layouts.default')

@section('content')
<div class="container">
{{ Former::framework('TwitterBootstrap3') }}
{{ Former::populate($member) }}
{{
    Former::vertical_open()
        ->rules(['name' => 'required'])
        ->method('PATCH')
        ->action('/members/' . $member->id);
}}
    <div class="page-header">
    <div class="pull-right">
            {{
                Former::actions()
                    ->large_primary_submit('Save Changes')
                    ->large_inverse_reset('Reset');
            }}
            </div>
        <h1>Update Profile</h1>
    </div>
    <div class ="row">
        <div class = "col-xs-12 col-md-4">
            <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact Info</h3>
                </div>
                <div class="panel-body">
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
                        Former::text('mobile_phone')
                            ->class('form-control')
                            ->required();
                    }}
                    {{
                        Former::text('email')
                            ->class('form-control')
                            ->required();
                    }}
            </div>
            </div>
        </div>
        <div class = "col-xs-12 col-md-3">
            <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">Bio Stats</h3>
                </div>
                <div class="panel-body">
                    {{
                        Former::date('birthday')->forceValue( $member->birthday !== null ? $member->birthday->format('Y-m-d') : '0000-00-00');
                    }}
                    <?php
                        $heightSelectArray = [];
                        for ($i=58; $i <= 84; $i++ ){
                            $heightSelectArray[$i] = (floor($i/12))."' ".($i%12).'"';
                        }
                    ?>
                    {{
                        Former::select('height')
                            ->options($heightSelectArray);
                    }}
                    {{
                        Former::number('weight')
                            ->min(90)
                            ->max(300);
                    }}
                </div>
            </div>
        </div>
        <div class = "col-xs-12 col-md-3">
            <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">USA Ultimate Series</h3>
                </div>
                <div class="panel-body">
                    {{
                        Former::select('series_intention')->options(array(
                            'yes'  => 'Yes',
                            'no'  => 'No',
                            'maybe'  => 'Maybe',
                        ));
                    }}
                    {{
                        Former::text('usauID');
                    }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class = "col-xs-12 col-md-6">
            <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">Ultimate Info</h3>
                </div>
                <div class="panel-body">
                    {{
                        Former::textarea('personal_strengths');
                    }}
                    {{
                        Former::textarea('personal_weaknesses');
                    }}
                    {{
                        Former::textarea('areas_to_improve');
                    }}
                </div>
            </div>
        </div>
        <div class = "col-xs-12 col-md-4">
            <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">Employement Info</h3>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
<!--
        <div class = "col-xs-12 col-md-4">             <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title"></h3>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
-->
        </div>
    {{
        Former::close();
    }}
    </div>
@stop