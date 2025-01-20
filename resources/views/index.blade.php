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
                <button id="open-camera" class="btn btn-sm btn-primary">Contact Administrator</button>
            </div>
        </div>
        <div id="qr-reader"></div>
    </div>
    <script>
        $(document).ready(function () {
            let qrReaderInstance;

            $('#open-camera').on('click', function () {
                $('#qr-reader').show();

                if (!qrReaderInstance) {
                    qrReaderInstance = new Html5Qrcode("qr-reader");
                }

                qrReaderInstance.start(
                    {facingMode: "environment"},
                    {
                        fps: 10,
                        qrbox: {width: 250, height: 250},
                    },
                    function (decodedText, decodedResult) {
                        console.log("Scanned URL:", decodedText);
                        if (isValidUrl(decodedText)) {
                            window.location.href = decodedText;
                        } else {
                            alert("Invalid QR code. It does not contain a valid URL.");
                        }

                        qrReaderInstance.stop();
                    },
                    function (errorMessage) {
                        console.warn("Scan error:", errorMessage);
                    }
                ).catch(function (err) {
                    console.error("Error starting QR reader:", err);
                });
            });

            function isValidUrl(string) {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            }
        });
    </script>
@endsection
