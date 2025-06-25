@extends('layouts.admin')

@section('content')
<h1 class="mb-4">Product Detail</h1>
    <div class="col-md-10">

        <div class="actions d-flex justify-content-evenly align-items-middle col-md-1 gap-2 mb-2">
            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning"><i data-feather="edit"></i></a>

            <form action="{{ route('admin.product.delete', $product->id) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger"><i data-feather="trash-2"></i></button>
            </form>

        </div>

        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->image }}" class="col-md-3 mb-4">
        <div class="mb-3">
            <p class="fs-5 m-0">Product Name</p>
            <p class="fs-4 fw-bold">{{ $product->name }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">Product Category</p>
            <p class="fs-4 fw-bold">{{ $product->category->name }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">Product Description</p>
            <p class="fs-4">{{ $product->description }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">Product Price</p>
            <p class="fs-4">@currency($product->price)</p>
        </div>
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
