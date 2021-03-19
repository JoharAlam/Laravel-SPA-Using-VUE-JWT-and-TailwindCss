@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <image src="Jot-Logo.svg" alt="Logo" style="width: 100px;"/>
        <h1 class="text-white text-3xl pt-8">Welcome Back</h1>
        <h2 class="text-blue-300">Enter your credentials below</h2>

        <form method="POST" action="{{ route('login') }}" class="pt-8">
            @csrf
            <div class="relative">
                <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">E-mail</label>
                <input id="email" type="email" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="email" value="{{ old('email') }}" placeholder="your@email.com" autocomplete="email" autofocus>

                @error('email')
                    <span class="text-red-500 text-sm pl-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="relative pt-3">
                <label for="password" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">Password</label>
                <input id="password" type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="password" placeholder="********" autocomplete="current-password">
                @error('password')
                    <span class="text-red-500 text-sm pl-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="pt-2">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="text-white" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full uppercase rounded text-left text-blue-900 bg-gray-400 py-2 px-3 font-bold">
                    {{ __('Login') }}
                </button>
            </div>

            <div class="flex justify-between pt-8 text-white text-sm font-bold">
                <a href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
                <a href="{{ route('register') }}">
                    Register
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
