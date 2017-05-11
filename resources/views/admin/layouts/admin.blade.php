
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Master Trico') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>
<div id="admin">
        <nav class="nav has-shadow main-nav">
            <div class="container">
                <div class="nav-left">
                    <a class="nav-item">
                        {{ config('app.name') }}
                    </a>
                    <a class="nav-item is-tab is-hidden-mobile is-active">Home</a>
                    <a class="nav-item is-tab is-hidden-mobile">Features</a>
                    <a class="nav-item is-tab is-hidden-mobile">Pricing</a>
                    <a class="nav-item is-tab is-hidden-mobile">About</a>
                </div>
                <span class="nav-toggle">
                          <span></span>
                          <span></span>
                          <span></span>
                        </span>
                <div class="nav-right nav-menu">
                    <a class="nav-item is-tab is-hidden-tablet is-active">Home</a>
                    <a class="nav-item is-tab is-hidden-tablet">Features</a>
                    <a class="nav-item is-tab is-hidden-tablet">Pricing</a>
                    <a class="nav-item is-tab is-hidden-tablet">About</a>
                    <a class="nav-item is-tab">
                        <figure class="image is-16x16" style="margin-right: 8px;">
                            <img src="http://bulma.io/images/jgthms.png">
                        </figure>
                        Profile
                    </a>
                    <a class="nav-item is-tab">Log out</a>
                </div>
            </div>
        </nav>

        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-2">
                    @include('admin.common.sidebar')
                </div>
                <div class="column is-10">

                    @yield('content')

                </div>
            </div>
        </div>



</div> {{--#admin--}}

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
