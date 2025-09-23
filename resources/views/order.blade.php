@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="title col-md-12 mb-4">
                <p class="fw-bold fs-1 text-center m-0">Pesanan Anda</p>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered table-stripped fs-5">
                <tr class="text-center">
                    <th style="width: 10%">No.</th>
                    <th>Order ID</th>
                    <th>Tanggal</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th style="width:10%" class="text-center">Action</th>
                </tr>
                {{-- Loop here --}}
                @foreach ($orders as $order)
                    <tr class="align-middle text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->total_product }}</td>
                        <td>@currency($order->grand_total)</td>
                        @if ($order->confirmation_status == 'waiting')
                            <td><span class="badge bg-warning">Waiting</span></td>
                        @elseif ($order->confirmation_status == 'confirmed')
                            @if ($order->isShipped)
                                <td><span class="badge bg-success">Shipped</span></td>
                            @else
                                <td><span class="badge bg-success">Confirmed</span></td>
                            @endif
                        @else
                            <td><span class="badge bg-danger">Canceled</span></td>
                        @endif

                        @if ($order->confirmation_status == 'confirmed')
                            @if ($order->payment_status == 'pending' && $order->snap_token != null)
                                <td class="text-center"><button class="btn btn-warning pay-now"
                                        data-token="{{ $order->snap_token }}"
                                        data-order_id="{{ $order->order_id }}">Pay</button></td>
                            @elseif ($order->payment_status == 'paid')
                                <td class="text-center"><a href="{{ route('invoice.index', $order->order_id) }}">
                                        <div class="btn btn-primary">Print</div>
                                    </a></td>
                            @else
                                {{-- <td class="text-center"><span class="text-muted">Status: {{ $order->payment_status }}</span></td> --}}
                                <td class="text-center">
                                    <form id="checkoutForm">
                                        @csrf
                                        <input type="hidden" name="grand_total" value="{{ $order->grand_total }}"
                                            id="grand_total">
                                        <input type="hidden" name="order_id" value="{{ $order->id }}" id="order_id">
                                        <button class="btn btn-warning" id="pay_cart" type="submit">Pay</button>
                                    </form>
                                </td>
                            @endif
                        @elseif ($order->confirmation_status == 'waiting')
                            <td class="text-center"><button class="btn btn-warning pay-now disabled"
                                    data-token="{{ $order->snap_token }}"
                                    data-order_id="{{ $order->order_id }}">Pay</button></td>
                        @else
                            <td class="text-center"><span class="badge bg-danger">Canceled</span></td>
                        @endif
                    </tr>
                @endforeach
                {{-- Loop here --}}
            </table>
        </div>
    </div>

    <script>
        console.log("A");
        $(document).ready(function() {
            $(".pay-now").click(function(e) {
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
            });


            $('#checkoutForm').on('submit', function(e) {

                console.log($('#order_id').val())
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('order.store') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        grand_total: $('#grand_total').val(),
                        order_id: $('#order_id').val(),
                    },
                    success: function(response) {
                        if (response.snap_token) {
                            snap.pay(response.snap_token, {
                                onSuccess: function(result) {
                                    window.location.href =
                                        `/invoice/${response.order_id}`
                                },
                                onPending: function(result) {
                                    window.location.href = '/order'
                                },
                                onError: function(result) {
                                    alert('gagal');
                                    console.log(result);
                                },
                                onClose: function() {
                                    alert('refreshed')
                                    window.location.href = '/order'
                                },
                            })
                        }
                    },
                    error: function(xhr) {
                        alert('gagal memproses pesanan.');
                    }
                });
            })
        });


        // $('#checkoutForm').on('submit', function(e) {
        //     console.log($('#order_id').val())
        //     e.preventDefault();
        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('order.store') }}",
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             grand_total: $('#grand_total').val(),
        //             order_id: $('#order_id').val(),
        //         },
        //         success: function(response) {
        //             if (response.snap_token) {
        //                 snap.pay(response.snap_token, {
        //                     onSuccess: function(result) {
        //                         window.location.href =
        //                             `/invoice/${response.order_id}`
        //                     },
        //                     onPending: function(result) {
        //                         window.location.href = '/order'
        //                     },
        //                     onError: function(result) {
        //                         alert('gagal');
        //                     },
        //                     onClose: function() {
        //                         alert('refreshed')
        //                         window.location.href = '/order'
        //                     },
        //                 })
        //             }
        //         },
        //         error: function(xhr) {
        //             alert('gagal memproses pesanan.');
        //         }
        //     });
        // })
    </script>
@endsection
