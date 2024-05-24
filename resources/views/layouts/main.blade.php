<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        @include('layouts.partials.nav')
        @yield('body')
        @include('layouts.partials.footer')
        @include('layouts.partials.footer-scripts')
    </body>
</html>