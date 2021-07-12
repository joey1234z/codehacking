@extends('layouts.admin')

<?php
if ($post->id) {
    $typeDisplay = "Update";
} else {
    $typeDisplay = "Add";
}
?>

@section('content')
<h1>{{$typeDisplay}} Post</h1>

@include('includes.errorListDisplay')


@if ($post->id)
{!! Form::open(['method'=>'PATCH', 'route'=>['admin.posts.update', $post->id], 'files'=>true]) !!}
@else
{!! Form::open(['method'=>'POST', 'route'=>'admin.posts.store', 'files'=>true]) !!}
@endif

<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', $post->title, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', $post->body, ['class'=>'form-control', 'rows'=>5]) !!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Category:') !!}
    <div>{!! Form::select('category_id', [''=>'- none -'] + $categoryDropdownOptions, $post->category_id) !!}</div>
</div>

<div class="form-group">
    {!! Form::label('photo', 'Photo:') !!}
    @if ($post->photo)
        <div style="padding-bottom:3px;"><img src="{{$post->photo->file}}" style="max-height:100px;" /></div>
    @endif
    <div>{!! Form::file('photo', ['class'=>'form-control']) !!}</div>
</div>

<div class="form-group">
    {!! Form::submit($typeDisplay.' Post', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}



@endsection