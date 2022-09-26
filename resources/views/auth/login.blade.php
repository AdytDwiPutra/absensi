@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">

{{-- <form id="formLogin" class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('login') }}">
    @csrf


                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required>

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                            <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('Remember Me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline hover:underline ml-auto"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('register'))
                        <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                            {{ __("Don't have an account?") }}
                            <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </p>
                        @endif
                    </div>
</form> --}}
    <div class="login-box">
        <div class="intro-x">

        <div class="spinner h-10 w-10 absolute right-10">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
        @if (Route::has('register'))
            <a class="underline hover:underline register-font absolute top-3 right-6" href="{{ route('register') }}">
                Daftar akun
            </a>
        @endif
            </div>
            <img src="{{ asset('images/guru-login.png') }}" class="h-48 ml-24 intro-y" alt="">
            <h2 class="intro-y font-lucida register-font" style="font-size: 1rem;margin-bottom:1%;">ABSENSI</h2>
            <img src="{{ asset('images/smk.png') }}" alt="" class="intro-y absolute top-6 left-4 w-9 h-8">
            <h2 class="intro-y font-lucida ml-10">SMK BAKTI ILHAM</h2>
        <br>
        <form id="formLogin" class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="user-box">
                <input type="text" name="email" required="" autocomplete="off">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <a href="#" onclick="document.getElementById('formLogin').submit();">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                LOGIN
            </a>
        </form>
    </div>
</main>
@endsection
