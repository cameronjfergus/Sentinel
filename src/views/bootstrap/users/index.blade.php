@extends(Config::get('Sentinel::views.layout'))

{{-- Web site Title --}}
@section('title')
@parent
Users
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <div class='btn-group'>
                <a class='btn btn-primary' href="{{ route('sentinel.users.create') }}">Create User</a>
            </div>
        </div>
        <h1>Current Users</h1>
    </div>
</div>

<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <th>User</th>
                <th>Status</th>
                <th>Options</th>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="{{ action('Sentinel\UserController@show', array($user->hash)) }}">{{ $user->email }}</a></td>
                    <td>{{ $user->status }} </td>
                    <td>
                        <button class="btn btn-default" type="button" onClick="location.href='{{ action('Sentinel\UserController@edit', array($user->hash)) }}'">Edit</button>
                        @if ($user->status != 'Suspended')
                            <button class="btn btn-default" type="button" onClick="location.href='{{ action('Sentinel\UserController@suspend', array($user->hash)) }}'">Suspend</button>
                        @else
                            <button class="btn btn-default" type="button" onClick="location.href='{{ action('Sentinel\UserController@unsuspend', array($user->hash)) }}'">Un-Suspend</button>
                        @endif
                        @if ($user->status != 'Banned')
                            <button class="btn btn-default" type="button" onClick="location.href='{{ action('Sentinel\UserController@ban', array($user->hash)) }}'">Ban</button>
                        @else
                            <button class="btn btn-default" type="button" onClick="location.href='{{ action('Sentinel\UserController@unban', array($user->hash)) }}'">Un-Ban</button>
                        @endif
                        <button class="btn btn-default action_confirm" href="{{ action('Sentinel\UserController@destroy', array($user->hash)) }}" data-token="{{ Session::getToken() }}" data-method="delete">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
