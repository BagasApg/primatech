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
                    <th>Tanggal</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th style="width:10%"></th>
                </tr>
                {{-- Loop here --}}
                @foreach ($orders as $order)
                    <tr class="align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->total_product }}</td>
                        <td>@currency($order->grand_total)</td>
                        <td class="text-center"><a href="{{ route('invoice.index', $order->id) }}">
                                <div class="btn btn-primary">Print</div>
                            </a></td>
                    </tr>
                @endforeach
                {{-- Loop here --}}
            </table>
        </div>
    </div>
@endsection
