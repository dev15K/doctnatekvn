@extends('admin.layouts.master')
@section('title')
    Detail Product
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Detail Product</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="d-flex gap-2 justify-content-between align-items-end">
                <div class="form-group w-100">
                    <label for="file_upload">FileUpload</label>
                    <input type="file" class="form-control w-100" id="file_upload" name="file_upload">
                </div>
                <button type="button" class="btn-sm btn-primary btn" data-bs-toggle="modal" data-bs-target="#modalFile">
                    View file
                </button>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="5">{{ $product->notes }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
        </form>
    </section>

    <div class="modal fade" id="modalFile" tabindex="-1" aria-labelledby="modelFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                        <p>
                            Cannot preview this file {{ $product->filename }}.
                            <a href="{{ $fileUrl }}" download="{{ $product->filename }}">Download</a>
                        </p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
