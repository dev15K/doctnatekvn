@extends('errors.layouts.master')
@section('title')
    Product
@endsection
@section('content')
    <style>
        .item_product_ {
            width: 50%;
        }

        .item_product_ .content_ {
            margin: 20px auto 0;
            width: 100%;
            max-width: calc(100% - 40px);
        }

        .item_product_ .search-bar {
            margin: 80px 0 0;
            height: 80px;
            width: 100%;
            min-width: 360px;
            padding: 0 20px 20px 20px;
            border-bottom: 1px solid rgba(1, 41, 112, 0.2);
        }

        .item_product_ .image_logo_ {
            width: 50px;
        }

        .item_product_ .search-form {
            width: calc(100% - 70px);
        }

        .item_product_ .search-form input {
            border: 0;
            font-size: 14px;
            color: #012970;
            border: 1px solid rgba(1, 41, 112, 0.2);
            padding: 7px 38px 7px 8px;
            border-radius: 3px;
            transition: 0.3s;
            width: 100%;
            height: 60px;
        }

        .item_product_ .search-form button {
            border: 0;
            padding: 0;
            margin-left: -30px;
            background: none;
        }

        @media screen and (max-width: 850px) {
            .item_product_ {
                width: 100%;
            }
        }
    </style>
    <div class="d-flex align-items-center justify-content-center flex-column vw-100 vh-100">
        <div class="item_product_ vh-100 bg-white position-relative">
            <header style="margin-left: 0" id="header"
                    class="header d-flex align-items-center justify-content-center position-absolute top-0 w-100">
                <h3 class="text-center">Quản lý văn bản NATEK</h3>
            </header>

            <div class="search-bar d-flex align-items-center justify-content-between">
                <div class="image_logo_">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </div>
                <form class="search-form d-flex align-items-center" method="POST" action="#">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="content_">
                <a href="{{ $product->file }}">
                    {{ $product->filename }}
                </a>

                <div class="list_action_ mt-3 d-flex align-items-center justify-content-start gap-2">
                    <a href="{{ $product->file }}" download="{{ $product->filename }}"
                       class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-download"></i>
                    </a>

                    <button type="button" id="printFile" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-printer"></i>
                    </button>
                </div>
            </div>

            <footer style="margin-left: 0" id="footer" class="footer position-absolute bottom-0 w-100">
                <div class="copyright">
                    &copy; Copyright <strong><span>{{ 'Dev Fullstack' }}</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="#">Dev Fullstack</a>
                </div>
            </footer>
        </div>
    </div>

    <div class="modal fade" id="modalFile" tabindex="-1" aria-labelledby="modelFileLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modelFileLabel">View file</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                        $fileUrl = $product->file;
                    @endphp
                    @if (strpos($mimeType, 'image') === 0)
                        <img src="{{ $fileUrl }}" alt="Image Preview" style="max-width: 100%; height: auto;">
                    @elseif (strpos($mimeType, 'video') === 0)
                        <video controls style="max-width: 100%; height: auto;">
                            <source src="{{ $fileUrl }}" type="{{ $mimeType }}">
                            Your browser does not support the video tag.
                        </video>
                    @elseif ($mimeType === 'application/pdf')
                        <embed src="{{ $fileUrl }}" type="application/pdf" width="100%" height="600px">
                    @elseif (strpos($mimeType, 'text') === 0)
                        <pre>{{ file_get_contents(public_path($product->file)) }}</pre>
                    @else
                        <p>Cannot preview this file {{ $product->filename }}.
                            <a href="{{ $fileUrl }}"
                               download="{{ $product->filename }}">Download</a></p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#printFile').on('click', function () {
                let fileUrl = '{{ $fileUrl }}';

                let newWindow = window.open(fileUrl, '_blank');

                newWindow.onload = function () {
                    newWindow.print();
                };
            });
        });
    </script>
@endsection
