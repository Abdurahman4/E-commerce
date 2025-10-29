@extends('layouts.app')

@section('content')

<link href="{{ asset('css/auth/register.css') }}" rel="stylesheet">

<div class="register-container">
  <div class="register-card">
    <div class="Register-header">
      <h1 class="Register-title">Sign Up</h1>
    </div>
    @if ($errors->any())
  <div class="alert alert-danger" id="errorAlert">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <span style="cursor:pointer; float:right;
    " onclick="document.getElementById('errorAlert').remove()">×</span>
  </div>
@endif

    <form action="{{ route('register.post') }}" method="POST">

      @csrf

      <input type="text" name="name" class="sign-up-input" placeholder="name" required>


      <input type="email" name="email" value="{{ old('email') }}"
      class="sign-up-input"
      placeholder="email"
      required>

      <input type="password" name="password"
      class="sign-up-input"
      placeholder="password"
      required>

      <input type="password" name="password_confirmation"
      class="sign-up-input"
      placeholder="Confirm Password"
      required>

      <button type="submit" class="sign-up-btn">
        Sign up
      </button>
    </form>
    <div class="sign in">
      <p> Already have an account?
        <a href="{{ route('login') }}"> Sign in</a>
      </p>


