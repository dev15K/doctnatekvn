@extends('errors.layouts.master')
@section('title')
    401 Unauthorized
@endsection
@section('content')
    <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>401</h1>
            <h2>Unauthorized.</h2>
            <a class="btn" href="{{ route('auth.login') }}?url_callback={{$callback}}">Back To Home</a>
            <img src="{{ asset('img/not-found.svg') }}" class="img-fluid py-5" alt="Unauthorized">
            <div class="credits">
                Designed by <a href="#">Dev Fullstack</a>
            </div>
        </section>

    </div>
@endsection
