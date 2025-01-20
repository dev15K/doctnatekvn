@extends('errors.layouts.master')
@section('title')
    Homepage
@endsection
@section('content')
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        #qr-reader {
            display: none;
            width: 300px;
            margin-top: 20px;
        }
    </style>
    <div class="d-flex align-items-center justify-content-center flex-column vw-100 vh-100">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title d-flex gap-2">Welcome to
                    <div class="text-uppercase">doctnatekvn</div>
                </h5>
                <p class="card-text">Wish you have a good experience on our platform!</p>
                <p class="card-footer">
                    Best regards,
                    <br>
                    Dev Fullstack Team.
                </p>
            </div>
        </div>
        <div id="qr-reader"></div>
    </div>
@endsection
