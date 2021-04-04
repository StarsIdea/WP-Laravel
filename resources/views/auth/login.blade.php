@extends('layouts.adminTemplate')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<form action = "{{ 'login' }}" method="POST">
<h1>Login</h1>
@csrf
<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('username') }}
    {{ $errors->first('password') }}
</p>

<p>
    <label for="username">username Address</label>
    <input type="text" name="username" value="{{ old('username')}}">
</p>

<p>
    <label for="username">Password</label>
    <input type="password" name="password">
</p>

<p><input type="submit" value="SUBMIT"></p>
</form>
@endsection