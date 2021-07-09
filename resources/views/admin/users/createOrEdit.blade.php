@extends('layouts.admin')

@section('content')
<h1>{{$typeDisplay}} User</h1>

@include('includes.errorListDisplay')



{!! Form::open(['method'=>'POST', 'route'=>'admin.users.store', 'files'=>true]) !!}

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
    <div>{!! Form::select('is_active', [1 => 'Active',  0 => 'inactive'], intval($user->is_active)) !!}</div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('role_id', 'Role:') !!}
    <div>{!! Form::select('role_id', [''=>'- none -'] + $roleDropdownOptions, $role_id) !!}</div>
</div>

<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    <div>{!! Form::file('avatar', ['class'=>'form-control']) !!}</div>
</div>

<div class="form-group">
    {!! Form::submit($typeDisplay.' User', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}



@endsection