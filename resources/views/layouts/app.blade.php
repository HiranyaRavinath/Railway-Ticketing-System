<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.header')
<main class="py-4">
    @yield('content')
</main>
</html>
