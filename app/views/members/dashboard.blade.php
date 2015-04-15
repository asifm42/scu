@extends('layouts.default')
@section('title', 'SCU Dashboard')
@section('content')
<div class="container">
    <div class="page-header">
        <a href="{{route('members.edit', $member->id)}}" class="btn btn-default pull-right">Update Profile</a>
        <h1>{{ $member->name }}</h1>
    </div>
    <div class="row">
        <div class = "col-xs-12 col-md-4">             <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact Info</h3>
                </div>
                <div class="panel-body">
                    <dl>
                        <dt>Email</dt>
                        <dd>{{ $member->email }}</dd>
                        <dt>Nickname</dt>
                        <dd>{{ $member->nickname}}</dd>
                        <dt>Phone</dt>
                        <dd>{{ $member->mobile_phone}}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class = "col-xs-12 col-md-3">             <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">Bio Info</h3>
                </div>
                <div class="panel-body">
                    <dl>
                        <dt>Birthday</dt>
                        <dd>{{ $member->birthday !== null ? $member->birthday->format('F jS, Y') : 'N/A'}}</dd>
                        <dt>Height</dt>
                        <dd>{{ $member->getHeightString()}}</dd>
                        <dt>Weight</dt>
                        <dd>{{ $member->weight}}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class = "col-xs-12 col-md-3">             <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">UsaU Series Info</h3>
                </div>
                <div class="panel-body">
                    <dl>
                        <dt>UsaU ID</dt>
                        <dd>{{ $member->usauID}}</dd>
                        <dt>Series Intention</dt>
                        <dd>{{ $member->series_intention}}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class = "col-xs-12 col-md-6">             <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title">Ultimate Info</h3>
                </div>
                <div class="panel-body">
                    <dl>
                        <dt>Playing history</dt>
                        <dd>{{ $member->playing_history}}</dd>
                        <dt>Personal strengths</dt>
                        <dd>{{ $member->personal_strengths}}</dd>
                        <dt>Personal weaknesses</dt>
                        <dd>{{ $member->personal_weaknesses}}</dd>
                        <dt>Areas desire to improve</dt>
                        <dd>{{ $member->areas_to_improve}}</dd>
                    </dl>
                </div>
            </div>
        </div>
<!--    <div class = "col-xs-12 col-md-4">             <div class="panel panel-trace-paper">
                <div class="panel-heading">
                    <h3 class="panel-title"></h3>
                </div>
                <div class="panel-body">
                    <dl>
                        <dt></dt>
                        <dd></dd>
                    </dl>
                </div>
            </div>
        </div>-->

    </div>
</div>
@stop