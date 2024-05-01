{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="text-white">
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('layouts.header')

</head>

<body>
    {{-- @include('frontend.layouts.header') <!-- Include header --> --}}
    @include('layouts.topbar')

    <div class="ch-container">
        <div class="row">
            @include('layouts.left_menu')
            
            <div id="content" class="col-lg-10 col-sm-10">
                <!-- content starts -->
                {{-- <div>
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{ asset('/') }}#">Home</a>
                        </li>
                        <li>
                            <a href="{{ asset('/') }}#">Dashboard</a>
                        </li>
                    </ul>
                </div> --}}
                {{-- @yield('content') --}}
                <main class="text-white">
                    {{ $slot }}
                </main>
            </div>
        </div>

        

        <hr>

        {{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3>Settings</h3>
                    </div>
                    <div class="modal-body">
                        <p>Here settings can be configured...</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                    </div>
                </div>
            </div>
        </div> --}}

        <footer class="row">
            <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://usman.it" target="_blank">Muhammad
                    Usman</a> 2012 - 2020</p>

            <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                    href="http://usman.it/free-responsive-admin-template">Charisma</a></p>
        </footer>
    </div>

    @include('layouts.footer')

</body>

</html>
