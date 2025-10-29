@extends('layouts.app')

@section('content')

<!-- ربط ملف CSS -->
<link href="{{ asset('css/auth/login.css') }}" rel="stylesheet">

<div class="login-container">
    <div class="login-card">
        <!-- العنوان -->
        <div class="login-header">
            <h1 class="login-title">Welcome Back 👋</h1>
            <p class="login-subtitle">Login to continue your journey</p>
        </div>


        @if(session('error'))
        <div class="login-alert" id="errorAlert">
            {{ session('error') }}
            <span class="close-btn" onclick="hideAlert()">×</span>
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <!-- email -->
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="login-input" 
                   placeholder="Enter your email" 
                   required>

            <!-- password  -->
            <input type="password" name="password" 
                   class="login-input" 
                   placeholder="Enter your password" 
                   required>

            <!-- options -->
            <div class="login-options">
                <div class="login-remember">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="#" onclick="alert('Password reset not available yet')" class="login-forgot">
                      Forgot password?
                </a>
            </div>

            <!-- login button  -->
            <button type="submit" class="login-btn">
                🔐 Login
            </button>
        </form>

        <!--  register link -->
        <div class="login-signup">
            <p>Don't have an account?  
                <a href="{{ route('register') }}">Create one here</a>
            </p>
        </div>
    </div>
</div>
<script>
     document.addEventListener('DOMContentLoaded', function() {
        const alertBox = document.getElementById('errorAlert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500); // بعد ما يصير شفاف، نحذفه من الصفحة
            }, 4000); // بعد 4 ثواني
        }
    });
    </script>
@endsection
