@extends('errors.layouts.master')
@section('title')
    404 Page Not Found
@endsection
@section('content')
    <div class="container">

        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>404</h1>
            <h2>The page you are looking for does not exist.</h2>
            <a class="btn" href="{{ route('home') }}">Back To Home</a>
            <img src="{{ asset('img/not-found.svg') }}" class="img-fluid py-5" alt="Page Not Found">
            <div class="credits">
                Designed by <a href="#">Dev Fullstack</a>
            </div>
        </section>

    </div>
@endsection
