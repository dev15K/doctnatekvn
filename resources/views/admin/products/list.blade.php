@extends('admin.layouts.master')
@section('title')
    List Product
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active">List Product</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <table class="table table-hover">
            <colgroup>
                <col width="8%">
                <col width="x">
                <col width="15%">
            </colgroup>
            <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Filename</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th class="text-center" scope="row">{{ $loop->index + 1 }}</th>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a target="_blank"
                               href="{{ route('product.show', $product->id) }}">{{ $product->filename }}</a>
                            <a href="{{ $product->file }}" download="{{ $product->filename }}"><i
                                    class="bi bi-download"></i></a>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-2 justify-content-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalQrCode"
                                    data-id="{{ $product->id }}" class="btn btn-sm btn-success openQrCode">
                                QR Code
                            </button>
                            <a href="{{ route('admin.products.detail', $product->id) }}" class="btn btn-sm btn-primary">Detail</a>
                            <button class="btn btn-sm btn-danger btnDelete" data-product="{{ $product->id }}"
                                    type="button">Delete
                            </button>
                            <div class="d-none">
                                <form method="POST" action="{{ route('admin.products.delete', $product->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button id="btnDeleteSubmit{{ $product->id }}" class="btn btn-sm btn-danger"
                                            type="submit">Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links('pagination::bootstrap-5') }}
    </section>

    <div class="modal fade" id="modalQrCode" tabindex="-1" aria-labelledby="modalQrCodeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalQrCodeLabel">QR Code</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="showQrCode" class="d-flex align-items-center justify-content-center">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnDownload" class="btn btn-primary">Download</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.btnDelete').click(function () {
                if (!confirm('Are you want to delete this product?')) {
                    return false;
                }

                let productId = $(this).data('product');

                $('#btnDeleteSubmit' + productId).click();
            })

            $('.openQrCode').click(function () {
                let productId = $(this).data('id');

                let url = `{{ route('qr.code.api.show.products', ['id' => ':id']) }}`;
                url = url.replace(':id', productId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    async: false,
                    success: function (data, textStatus) {
                        $('#showQrCode').html(data);
                    },
                    error: function (request, status, error) {
                        let data = JSON.parse(request.responseText);
                        alert(data.message);
                    }
                });
            })

            $('#btnDownload').click(function () {
                const $svg = $('#showQrCode').find('svg');
                const svgString = new XMLSerializer().serializeToString($svg[0]);

                const svgBlob = new Blob([svgString], { type: 'image/svg+xml;charset=utf-8' });
                const url = URL.createObjectURL(svgBlob);

                const img = new Image();
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    canvas.width = $svg.attr('width');
                    canvas.height = $svg.attr('height');

                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0);

                    const pngUrl = canvas.toDataURL('image/png');

                    const downloadLink = $('<a></a>')
                        .attr('href', pngUrl)
                        .attr('download', 'qr-code.png')
                        .appendTo('body');
                    downloadLink[0].click();

                    downloadLink.remove();
                    URL.revokeObjectURL(url);
                };

                img.src = url;
            })
        })
    </script>
@endsection
