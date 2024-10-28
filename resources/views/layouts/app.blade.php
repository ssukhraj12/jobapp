<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.common.head')
<body>
    <div id="app">
        @include('layouts.common.topmenu')
        <div class="container-fluid">
            <div class="row">
                @guest
                    <div class="col">
                        <div class="main p-2">
                            @yield('content')
                        </div>
                    </div>
                @else
                    <div id="sidebar" class="col bg-dark px-0">
                        @include('layouts.common.sidebar')
                    </div>
                    <div id="rside" class="col bg-light">
                        <div class="main py-2">
                            @yield('content')
                        </div>
                    </div>
                @endguest
                    @vite(['resources/js/app.js'])
            </div>
        </div>
    </div>
</body>
</html>
