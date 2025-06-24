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
                    @php
                        $total_price = 0;
                    @endphp
                    @forelse ($carts as $cart)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cart->product->name }}</td>
                            <td class="text-center">{{ $cart->qty }}</td>
                            <td>@currency($cart->product->price * $cart->qty)</td>
                        </tr>
                        @php
                            $total_price += $cart->product->price * $cart->qty;
                        @endphp
                    @empty
                    @endforelse
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="fs-5">Total Belanja (termasuk pajak): <span class="text-decoration-underline">
                            @currency($total_price)</span></p>
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="grand_total" value="{{ $total_price }}">
                        <button class="btn btn-primary" type="submit">Order & Print PDF</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
