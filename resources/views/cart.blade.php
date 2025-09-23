@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="title col-md-12 mb-4">
                <p class="fw-bold fs-1 text-center m-0">Keranjang Belanja</p>
            </div>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-9 mx-auto fs-5">
                <table class="table table-bordered border-black bg-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk dengan ID</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $total_price = 0;
                    @endphp
                    @forelse ($carts as $cart)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cart->product->name }}</td>
                            <td class="text-center">
                            <div class="col d-flex justify-content-between
                            ">

                                <button class="btn btn-danger btn-sm btn-minus" data-id={{ $cart->id }}>-</button>
                                <span class="text-center mx-4" id="qty-{{ $cart->id }}"$>{{ $cart->qty }}</span>
                                <button class="btn btn-success btn-sm btn-plus " data-id="{{ $cart->id }}">+</button>
                            </div>
                        </td>
                            <td>@currency($cart->product->price * $cart->qty)</td>
                            <td class="text-center">
                            <form action="{{ route('cart.removeItem', $cart->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</buton>
                            </form>
                            </td>
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
                    <form method="POST" action="{{ route('cart.checkout') }}">
                        @csrf
                        <input type="hidden" name="grand_total" value="{{ $total_price }}">
                        <button class="btn btn-primary" type="submit">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(".btn-plus, .btn-minus").on('click', function() {
           let id = $(this).data('id')
           let type = $(this).hasClass('btn-plus') ? 'plus' : 'minus';

            $.ajax({
                type: "POST",
                url: "{{ route('cart.update') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    type: type,
                },
                success: function(response) {
                console.log(response);
                    window.location.reload();
                    // $(`#qty-${response.id}`).html(response.qty);
                },
            });
        })
    </script>
@endsection
