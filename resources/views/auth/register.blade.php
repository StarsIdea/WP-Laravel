@extends('layouts.adminTemplate')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<form action = "{{ 'register' }}" method="POST">
<h1>Register</h1>
@csrf
<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('username') }}
    {{ $errors->first('email') }}
    {{ $errors->first('password') }}
</p>

<p>
    <label for="username">UserName</label>
    <input type="text" name="username" value="{{ old('username')}}">
</p>

<p>
    <label for="email">Email</label>
    <input type="email" name="email">
</p>

<p>
    <label for="password">Password</label>
    <input type="password" name="password">
</p>

<p>
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation">
</p>

<p><input type="submit" value="SUBMIT"></p>
</form>
@endsection