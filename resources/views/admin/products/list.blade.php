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
    <script>
        $(document).ready(function () {
            $('.btnDelete').click(function () {
                if (!confirm('Are you want to delete this product?')) {
                    return false;
                }

                let productId = $(this).data('product');

                $('#btnDeleteSubmit' + productId).click();
            })
        })
    </script>
@endsection
