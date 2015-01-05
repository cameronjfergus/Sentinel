@extends(Config::get('Sentinel::views.layout'))

{{-- Web site Title --}}
@section('title')
@parent
Edit Group
@stop

{{-- Content --}}
@section('content')
<form method="POST" action="{{ route('sentinel.groups.update', $group->id) }}" accept-charset="UTF-8">
    <div class="row">
        <div class="small-6 large-centered columns">
            <h3>Edit Group</h3>

            <div class="row">
                <div class="small-2 columns">
                    <label for="right-label" class="right inline">Name</label>
                </div>
                <div class="small-10 columns {{ ($errors->has('name')) ? 'error' : '' }}">
                    <input placeholder="Name" name="name" value="" type="text">
                    {{ ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') }}
                </div>
            </div>
    
            <div class="row">
                {{ Form::label('edit_memberships', 'Permissions') }}  
                <?php $defaultPermissions = Config::get('Sentinel::auth.default_permissions', []); ?>
                @foreach ($defaultPermissions as $permission)
                    <div class="small-10 small-offset-2 columns">
                       <input name="permissions[{{ $permission }}]" value="1" type="checkbox" {{ (isset($permissions[$permission]) ? 'checked' : '') }}>
                       {{ ucwords($permission) }}
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="small-10 small-offset-2 columns">
                    <input name="id" value="{{ $group->id }}" type="hidden">
                    <input name="_method" value="PUT" type="hidden">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="button" value="Save Changes" type="submit">
                </div>
            </div>

        </div>
    </div>
{{ Form::close() }}
@stop