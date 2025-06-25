@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="title col-md-12 mb-4">
                <p class="fw-bold fs-1 text-center m-0">Pesanan Anda</p>
            </div>
        </div>
        <div class="row">
            <table class="table fs-5">
                <tr>
                    <th style="width: 10%">No.</th>
                    <th>Order ID</th>
                    <th>Tanggal</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th style="width:10%"></th>
                </tr>
                {{-- Loop here --}}
                @foreach ($orders as $order)
                    <tr class="align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->total_product }}</td>
                        <td>@currency($order->grand_total)</td>
                        <td class="text-center">
                            @if ($order->payment_status == 'pending')
                                <button class="btn btn-warning pay-now"
                                    data-token="{{ $order->snap_token }}" data-order_id="{{ $order->order_id }}">Pay</button>
                            @elseif ($order->payment_status == 'paid')
                                <a href="{{ route('invoice.index', $order->order_id) }}">
                                    <div class="btn btn-primary">Print</div>
                                </a>
                            @else
                                <span class="text-muted">Status: {{ $order->payment_status }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                {{-- Loop here --}}
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function () {
    $(".pay-now").click(function (e) {
        e.preventDefault();
        console.log($(this).data('token'));
    });

        $('.pay-now').on('click', function(e) {
            e.preventDefault();
            const token = $(this).data('token');
            const order_id = $(this).data('order_id');
            snap.pay(token, {
                onSuccess: function(result) {
                    window.location.href = `/invoice/${order_id}`;
                },
                onPending: function(result) {
                    window.location.href = "{{ route('order.index') }}"
                },
                onError: function(result) {
                    alert('Gagal');
                }
            })
        })

    });
    </script>
@endsection
