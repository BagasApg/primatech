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
                <table class="table table-bordered border-black bg-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk dengan ID</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Thermometer 10291</td>
                        <td>1</td>
                        <td>@currency(250000)</td>
                    </tr>
                </table>
                <p class="fs-5">Total Belanja (termasuk pajak): <span class="text-decoration-underline">
                        @currency(250000)</span></p>
            </div>
        </div>
    </div>
@endsection
