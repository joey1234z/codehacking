@extends('layouts.admin')

<?php
if ($user->id) {
    $typeDisplay = "Update";
} else {
    $typeDisplay = "Add";
}
?>

@section('content')
<h1>{{$typeDisplay}} User</h1>

@include('includes.errorListDisplay')


@if ($user->id)
{!! Form::open(['method'=>'PATCH', 'route'=>['admin.users.update', $user->id], 'files'=>true]) !!}
@else
{!! Form::open(['method'=>'POST', 'route'=>'admin.users.store', 'files'=>true]) !!}
@endif

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', $user->email, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('is_active', 'Active?') !!}
    <div>{!! Form::select('is_active', [1 => 'Active',  0 => 'inactive'], $user->is_active) !!}</div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('role_id', 'Role:') !!}
    <div>{!! Form::select('role_id', [''=>'- none -'] + $roleDropdownOptions, $user->role_id) !!}</div>
</div>

<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    @if ($user->photo)
        <div style="padding-bottom:3px;"><img src="{{$user->photo->file}}" style="max-height:100px;" /></div>
    @endif
    <div>{!! Form::file('photo', ['class'=>'form-control']) !!}</div>
</div>

<div class="form-group">
    {!! Form::submit($typeDisplay.' User', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}



@endsection