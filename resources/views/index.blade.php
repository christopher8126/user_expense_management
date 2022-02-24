<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body>

        @if (Auth::check())

            @if (auth()->user()->hasrole('admin'))
                @php
                    $roles = 'admin';
                @endphp
            @else
                @php
                    $roles = 'user';
                @endphp
            @endif

            <script>
                window.Laravel = {!!json_encode([
                    'isLoggedin' => true,
                    'user' => Auth::user(),
                    'roles' => $roles
                ])!!}
            </script>

        @else
            <script>
                window.Laravel = {!!json_encode([
                    'isLoggedin' => false
                ])!!}
            </script>
        @endif

        <div id="app">
            <router-view>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
        <script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
