@extends('pub_theme::layouts.app')
@section('content')
    <div class="mh-full-screen d-flex align-items-center dark-overlay">
        <img class="bg-image" src="{{ Theme::asset('pub_theme::img/bg_404.jpg') }}"
            alt="Not found">
        <div class="container text-white text-lg overlay-content py-6 py-lg-0">
            <h1 class="display-3 font-weight-bold mb-5">Oops, that page is not here.</h1>
            <p class="font-weight-light mb-5">{{ $message ?? '' }}</p>
            <p class="mb-6">
                <a class="btn btn-outline-light" href="{{ url($lang) }}">
                    <i class="fa fa-home mr-2"></i>
                    Start from the Homepage
                </a>
            </p>
            <p class="h4 text-shadow">Error 404</p>
        </div>
        {{ $message ?? $msg ?? '' }}
    </div>
@endsection
