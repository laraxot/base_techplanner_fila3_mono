<<<<<<< HEAD
<x-layouts.main>
    <x-section slug="header" />

    {{ $slot }}

    <x-section slug="footer" />
</x-layouts.main>
=======
@extends('pub_theme::layouts.base')

@section('body')
    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
>>>>>>> 1b374b6 (.)
