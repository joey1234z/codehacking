@extends('layouts.admin')

@section('content')
<h1>Categories</h1>

<div style="padding-bottom:15px;">
{!! Form::open(['method'=>'POST', 'route'=>'admin.categories.store', 'files'=>true]) !!}
{!! Form::text('name', '', ['class'=>'form-control', 'style'=>'width:25%;min-width:150px;display:inline-block']) !!}
<button class="btn btn-primary">Add Category</button>
{!! Form::close() !!}
</div>

@if ($categories)
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
@foreach ($categories as $category)

        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->created_at->diffForHumans()}}</td>
            <td><a href="{{route('admin.categories.edit', $category)}}" class="btn btn-primary">edit</a></td>
            <td>{!! Form::open(['method'=>'DELETE', 'route'=>['admin.categories.destroy', $category]]) !!}
                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}</td>
        </tr>

@endforeach
    </tbody>
</table>
@else
    <br><br><div><em>no categories found</em></div>
@endif



@endsection