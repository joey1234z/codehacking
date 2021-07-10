@extends('layouts.admin')

@section('content')
<h1>Posts</h1>

<a href="{{route('admin.posts.create')}}" class="btn btn-primary">add</a>

@if ($posts)
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">User</th>
            <th scope="col">Photo</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
@foreach ($posts as $post)

        <tr>
            <td>{{$post->id}}</td>
            <td>@if ($post->user) 
                    {{$post->user->name}} ({{$post->user->email}})
                @else
                    <em>no user</em>
                @endif</td>
            <td>@if ($post->photo) 
                    <img src="{{$post->photo->file}}" style="max-height:100px;">
                @else
                    <em>no image</em>
                @endif</td>
            <td>{{$post->title}}</td>
            <td>@if ($post->category) 
                    {{$post->category->name}}
                @else
                    <em>no category</em>
                @endif</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td><a href="{{route('admin.posts.edit', $post)}}" class="btn btn-primary">edit</a></td>
            <td>{!! Form::open(['method'=>'DELETE', 'route'=>['admin.posts.destroy', $post]]) !!}
                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}</td>
        </tr>

@endforeach
    </tbody>
</table>
@else
    <br><br><div><em>no posts found</em></div>
@endif



@endsection