@extends('layouts.base')

@section('content')
<style>
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="password"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus,
    input[type="datetime-local"]:focus,
    input[type="month"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[multiple]:focus,
    textarea:focus,
    select:focus {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }

    input[type="text"]:hover,
    input[type="email"]:hover,
    input[type="url"]:hover,
    input[type="password"]:hover,
    input[type="number"]:hover,
    input[type="date"]:hover,
    input[type="datetime-local"]:hover,
    input[type="month"]:hover,
    input[type="search"]:hover,
    input[type="tel"]:hover,
    input[type="time"]:hover,
    input[type="week"]:hover,
    input[multiple]:hover,
    textarea:hover,
    select:hover {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }

    input[type="text"]:active,
    input[type="email"]:active,
    input[type="url"]:active,
    input[type="password"]:active,
    input[type="number"]:active,
    input[type="date"]:active,
    input[type="datetime-local"]:active,
    input[type="month"]:active,
    input[type="search"]:active,
    input[type="tel"]:active,
    input[type="time"]:active,
    input[type="week"]:active,
    input[multiple]:active,
    textarea:active,
    select:active {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }
</style>

<!-- Log In Section Start -->
<div class="login-section">
    <div class="materialContainer">
        <div class="box">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-title">
                    <h2>Login</h2>
                </div>
                <div class="input">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" :value="old('email')" required autofocus autocomplete="email">
                    @error('email')
                        <span class="text-danger mt-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="text-danger mt-3">{{ $message }}</span>
                    @enderror
                </div>

                <a href="{{ route('password.request') }}" class="pass-forgot">Forgot your password?</a>

                <div class="button login">
                    <button type="submit">
                        <span>Log In</span>
                        <i class="fa fa-check"></i>
                    </button>
                </div>

                <p>Not a member? <a href="{{ route('register') }}" class="theme-color">Sign up now</a></p>
            </form>
        </div>
    </div>
</div>
<!-- Log In Section End -->
@endsection
