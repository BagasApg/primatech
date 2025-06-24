@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ratio ratio-1x1">
                            <svg class="w-100">
                                <rect width="100%" height="100%" fill="#8d8d8d"></rect>
                            </svg>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <p class="fs-4 fw-bold lh-sm">Walgreens Maximum Strength Daytime and Nighttime Severe Cold & Flu Caplets</p> 
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mx-4 bg-white shadow-sm">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="amount" id="amount" min="1"
                                    max="5" value="1">
                            </div>
                            <div class="col-md-6 d-flex align-items-center ps-0">
                                <p class="fs-5 m-0">Stok: 5</p>
                            </div>
                        </div>
                        <div class="btn btn-success w-100">Beli</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
