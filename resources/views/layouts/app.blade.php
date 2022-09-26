<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SMK BAKTI ILHAM</title>
    <link rel="icon" type="image/png" href="{{ asset('images/smk.png') }}"/>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bg.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body class="bg-teal-300 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class=" py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                </div>
<div class="background">
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
</div>

            </div>
        </header>


        @yield('content')
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('dist/js/app.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!-- Javascript -->
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-steps/jquery.steps.js') }}"></script>

<!-- page js file -->
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('js_iconic/pages/forms/form-wizard.js') }}"></script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

$(".form-submit").submit(function(e) {
    e.preventDefault();
});
</script>
</body>
</html>
