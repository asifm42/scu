@extends('layouts.default')

@section('content')

    <div class ="row">
        <div class = "col-md-4 col-md-offset-1">
            <div>
                <h2>All Users</h2>
            </div>
            <div class='well'>
                @if ($users->count() > 0)
                    <ul>
                    @foreach ($users as $user)
                        <li><a href={{ url('users/' . $user->id) }}>{{ $user->name }}</a></li>
                    @endforeach
                    </ul>
                    {{ $users->links() }}
                @else
                    <p>there are no other users</p>
                @endif
            </div>
        </div>
    </div>
@stop