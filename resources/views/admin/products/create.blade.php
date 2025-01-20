@extends('admin.layouts.master')
@section('title')
    Create Product
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Create Product</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file_upload">FileUpload</label>
                <input type="file" class="form-control" id="file_upload" name="file_upload" required>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Create</button>
        </form>
    </section>
@endsection
