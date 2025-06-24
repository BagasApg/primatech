@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="title col-md-12 mb-4">
                <p class="fw-bold fs-1 text-center m-0">Keranjang Belanja</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 mx-auto fs-5">
                <table class="table table-bordered border-black bg-white mb-4">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Produk dengan ID</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>

                    {{-- Loop here --}}
                    <tr>
                        <td class="text-center">1</td>
                        <td>Thermometer 10291</td>
                        <td class="text-center">1</td>
                        <td>@currency(250000)</td>
                    </tr>
                    {{-- Loop here --}}

                </table>
                <div class="d-flex justify-content-between">
                    <p class="fs-5 m-0">Total Belanja (termasuk pajak): <span class="text-decoration-underline">
                            @currency(250000)</span></p>
                    <a href="">
                        <div class="btn btn-success">Checkout</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
