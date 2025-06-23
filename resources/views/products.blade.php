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
                    @for ($i = 0; $i < 10; $i++)
                        <div class="col-md-4 px-4">
                            <a href="/product/{{ $i+1029 }}" class="text-decoration-none">
                                <div class="card bg-white mb-4 shadow-sm rounded-3">
                                    <div class="card-body">
                                        <div class="product-image ratio ratio-1x1 mb-2">
                                            {{-- IMAGE --}}
                                            <svg class="w-100">
                                                <rect width="100%" height="100%" fill="#8d8d8d"></rect>
                                            </svg>
                                            {{-- IMAGE --}}
                                        </div>
                                        <p class="fs-5 mb-2">Product {{ $i }} with extra supplement enhanced for
                                            well
                                            being includes spray of hygienation</p>
                                        <p class="fs-5 text-body-secondary m-0">Stok {{ $i * 9 }}</p>
                                        <p class="fs-4">@currency(($i + 1) * 11900)</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-md-3">
                <p class="fs-4 mx-4 fw-bold mb-2">Filter</p>
                <div class="card mx-4 bg-white shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">Categories</h4>
                        <p>Food</p>
                        <p>Food</p>
                        <p>Food</p>
                        <p>Food</p>
                        <p>Food</p>
                        <p>Food</p>
                        <p>Food</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
