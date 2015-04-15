@extends('layouts.default')
@section('title', 'Space City Ultimate (SCU)')
@section('content')
    <div class = "row">
        <div class = "col-xs-12 col-md-8 col-md-offset-2">
            <img class="homeLogo center-block" src={{ asset('assets/img/scu-logo-2014-initials.png') }} alt="SCU Logo">
            <h1 class="text-center white-header">Space City Ultimate</h1>
            <h2 class="text-center white-header">Houston's Competitive Ultimate <span class="strikethrough">Frisbee</span> Club</h2>
            <h3 class="text-center white-header">Learn | Compete | Teach</h3>
            <div class="text-center">
                <a class="btn btn-primary" href="#" role="button">2014 Highlight Video</a>
            </div>
        </div>
    </div>
    <div class ="row">
        <div class = "col-xs-12 col-md-8 col-md-offset-2">
            <div class ="row">
                <div class = "col-xs-12 col-md-6">
                    <div class="panel panel-trace-paper">
                      <div class="panel-heading">
                        <h3 class="panel-title">What is Ultimate?</h3>
                      </div>
                      <div class="panel-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/NhTHzkWoB6A" allowfullscreen></iframe>
                            </div>
                            <p>
                                Ultimate is a fast pace, non-contact sport that combines the non-stop movement and athletic endurance of soccer with the aerial passing skills of football, a game of Ultimate is played by two teams with a flying disc or Frisbee™ on a field with end zones, similar to football. Ultimate is governed by Spirit of the Game™ and is played in more than 42 countries by hundreds of thousands of men and women, girls and boys.
                            </p>
                            <a href="/what_is_ultimate" class="pull-right">Read More →</a>
                      </div>
                    </div>
                </div>
                <div class = "col-xs-12 col-md-6">
                    <div class="panel panel-trace-paper">
                      <div class="panel-heading">
                        <h3 class="panel-title">What is Space City Ultimate?</h3>
                      </div>
                      <div class="panel-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/_ymN0UQIFz4" allowfullscreen></iframe>
                            </div>
                            <p>
                                In its fifth season, Space City Ultimate (SCU) is more than just Houston’s Club Ultimate Frisbee team. SCU was created in 2010 to give competitive Ultimate players of all experience levels — from rookies to those with Nationals and Worlds experience — a platform to play with each other and push each other to their highest potential level by offering three competitive teams (Ignite, Eclipse, and Fuel) and the ability for players to move between the teams as they improve.
                            </p>
                            <a href="/what_is_ultimate" class="pull-right">Read More →</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop