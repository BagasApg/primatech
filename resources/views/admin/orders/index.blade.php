@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Orders</h1>

    <div class="col-md-8">
        <table class="table">
            <tr class="text-center">
                <th>#</th>
                <th>Order ID</th>
                <th class="w-25">Date</th>
                <th>Qty.</th>
                <th class="w-25">Grand Total</th>
                <th class="w-25">Status</th>
                <th class="w-25">Actions</th>
            </tr>
            @forelse($orders as $order)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total_product }}</td>
                    <td>@currency($order->grand_total)</td>
                    @if ($order->confirmation_status == 'waiting')
                        <td><span class="badge bg-warning">Need Approval</span></td>
                        <td class="d-flex justify-content-center gap-2">
                            <button class="btn btn-success" data-order_id="{{ $order->id }}" id="approveOrder"
                                onClick="approveOrder({{ $order->id }}, 'approve')">Approve</button>
                            <button class="btn btn-danger" id="reject-{{ $order->id }}"
                                onClick="approveOrder({{ $order->id }}, 'reject')">Reject</button>
                        </td>
                    @elseif ($order->confirmation_status == 'confirmed')
                        <td><span class="badge bg-success">Paid</span></td>
                        <td><button class="btn btn-success">Ship</button></td>
                    @else
                        <td><span class="badge bg-danger">Rejected</span></td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                    @endif
                </tr>
                <input type="hidden" name="order_id" value="{{ $order->id }}" id="order_id">
            @empty
                <td rowspan="7">Kosong</td>
            @endforelse
        </table>
    </div>

    <script>
        function approveOrder(order_id, confirmation) {
            $.ajax({
                type: "POST",
                url: `/order/confirm/${order_id}`,
                data: {
                    _token: '{{ csrf_token() }}',
                    order_id: order_id,
                    confirmation: confirmation,
                },
                success: function(response) {
                    window.location.href = '/admin/orders';
                    console.log(response);
                }

            })
        }
    </script>
@endsection
