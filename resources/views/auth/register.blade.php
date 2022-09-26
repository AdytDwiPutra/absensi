@extends('layouts.app')

@section('content')
<main class="sm:container absolute top-4 lg:left-1/2 sm:max-w-lg">
    <div id="wrapper" class="theme-cyan">
        <div class="w-full py-6 px-6">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
{{-- 
                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    {{ __('Register') }}
                </header> --}}

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST"
                    action="{{ route('register') }}">
                    @csrf

                    <div class="flex flex-wrap rounded">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Name') }}:
                        </label>

                        <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="user-box">
                        <input type="text" name="group_user" required="" autocomplete="off" value="2" hidden>
                    </div>

                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- <div class="flex flex-wrap">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            Sebagai:
                        </label>
                        <div class="container-select">
                            <select name="profesi" id="minimal-select">
                                <option value="0">- Pilih Profesi -</option>
                                <option value="1">Pengajar</option>
                                <option value="2">Staff Kependidikan</option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="flex flex-wrap">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required autocomplete="new-password">

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="form-input w-full"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit" id="register-font"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                            {{ __('Register') }}
                        </button>

                        <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                            {{ __('Already have an account?') }}
                            <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </p>
                    </div>

                </form>

            </section>
        </div>
    </div>
</main>


<div id="wrapper" class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"></div>
            <p>Loading ...</p>
        </div>
    </div>



    <!-- mani page content body part -->
    {{-- <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>Registration</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form id="wizard_with_validation" name="regisForm" method="POST" action="{{ route('registrasi') }}">
                                @csrf
                                <h3>Account Information</h3>
                                <div class="user-box">
                                    <input type="text" name="group_user" required="" autocomplete="off" value="2" hidden>
                                </div>

                                <fieldset>
                                    <div class="form-group form-float">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                            Email :
                                        </label>
                                        <input type="text" class="form-control" placeholder="" name="email" required>
                                    </div>
                                    <div class="form-group form-float">
                                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                            {{ __('Password') }}:
                                        </label>
                                        <input type="password" class="form-control" placeholder="" name="password" id="password" required>
                                    </div>
                                    <div class="form-group form-float">
                                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                            {{ __('Confirm Password') }}:
                                        </label>
                                        <input type="password" class="form-control" placeholder="" name="password_confirmation" required>
                                    </div>
                                </fieldset>
                                <h3>Profile Information</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                            {{ __('Name') }}:
                                        </label>
                                        <input type="text" name="name" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="form-group form-float">
                                        <label for="profesi" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                            Sebagai:
                                        </label>
                                        <div class="container-select" style="margin-right:80%">
                                            <select name="profesi" id="minimal-select">
                                                <option value="0">- Pilih Profesi -</option>
                                                <option value="1">Pengajar</option>
                                                <option value="2">Staff Kependidikan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                            No. Handphone :
                                        </label>
                                        <input type="text" name="nohp" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="form-group form-float">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                            Alamat :
                                        </label>
                                        <textarea name="alamat" cols="30" rows="3" placeholder="" class="form-control no-resize" required></textarea>
                                    </div>
                                </fieldset>
                                <h3>Verifikasi Wajah</h3>
                                <fieldset>
                                    Verikasi wajah AI

                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

</div>

@endsection
