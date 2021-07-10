@extends('layouts.admin')

@section('content')
<h1>Users</h1>

<a href="{{route('admin.users.create')}}" class="btn btn-primary">add</a>

@if ($users)
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Avatar</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Active?</th>
            
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
@foreach ($users as $user)

        <tr>
            <td>{{$user->id}}</td>
            <td>@if ($user->photo) 
                    <img src="{{$user->photo->file}}" style="max-height:100px;">
                @else
                    <em>no image</em>
                @endif</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td> 
                @if ($user->role) 
                    {{$user->role->name}}
                @else
                    <em>none</em>
                @endif
            </td>
            <td>@if ($user->is_active) 
                    <b>Active</b>
                @else
                    <em>Inactive</em>
                @endif</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td><a href="{{route('admin.users.edit', $user)}}" class="btn btn-primary">edit</a></td>
            <td>{!! Form::open(['method'=>'DELETE', 'route'=>['admin.users.destroy', $user]]) !!}
                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}</td>
        </tr>

@endforeach
    </tbody>
</table>
@else
    <br><br>div><em>no users found</em></div>
@endif



@endsection