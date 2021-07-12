@extends('layouts.admin')

<?php
if ($category->id) {
    $typeDisplay = "Update";
} else {
    $typeDisplay = "Add";
}
?>

@section('content')
<h1>{{$typeDisplay}} Category</h1>

@include('includes.errorListDisplay')


@if ($category->id)
{!! Form::open(['method'=>'PATCH', 'route'=>['admin.categories.update', $category->id], 'files'=>true]) !!}
@else
{!! Form::open(['method'=>'POST', 'route'=>'admin.categories.store', 'files'=>true]) !!}
@endif

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', $category->name, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($typeDisplay.' Category', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}



@endsection