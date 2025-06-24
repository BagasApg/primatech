@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 0 8rem">
        <div class="row">
            <div class="title col-md-12">
                <h1 class="fw-bold py-3">Produk</h1>
            </div>
        </div>
        <div class="products row d-flex justify-content-between mt-2">
            <div class="col-md-9">
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-md-4 px-4 mb-4 d-flex align-items-stretch">
                            <div class="card bg-white shadow-sm rounded-3 position-relative"
                                title="{{ $product->name . ' - ' . $product->description }}">
                                <div class="card-body d-flex flex-column align-items-stretch">
                                    <div class="product-image ratio ratio-1x1 mb-2">
                                        {{-- IMAGE --}}
                                        {{-- <svg class="w-100">
                                                <rect width="100%" height="100%" fill="#8d8d8d"></rect>
                                            </svg> --}}
                                        <img src="{{ asset($product->image) }}" alt="">
                                        {{-- IMAGE --}}
                                    </div>
                                    <p class="fs-5 mb-2">
                                        <strong>{{ Str::limit($product->name) }}</strong>
                                    </p>
                                    <p class="fs-5 mb-2">
                                        {{ Str::limit($product->description, 35) }}
                                    </p>
                                    <p class="fs-4">@currency($product->price)</p>
                                    <div class="mt-auto">

                                        <form action="{{ route('cart.addToCart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button class="btn btn-primary" type="submit">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                                <a href="/product/{{ $product->id }}" class="position-absolute w-100 top-0 start-0 end-0 bottom-0"></a>
                            </div>
                        </div>
                    @empty
                        <span>Kosong lee</span>
                    @endforelse
                </div>
            </div>
            <div class="col-md-3">
                <p class="fs-4 mx-4 fw-bold mb-2">Filter</p>
                <div class="card mx-4 bg-white shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">Categories</h4>
                        @foreach ($categories as $category)
                            <p>{{ $category->name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @for ($i = 1; $i <= 4; $i++)
                        @endfor --}}

{{-- @for ($i = 1; $i <= 4; $i++)
                        @endfor --}}
