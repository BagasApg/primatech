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
                <tr class="align-middle">
                    <td>1</td>
                    {{-- <td>{{ $loop->iteration }}</td> --}}

                    <td>12-4-2025</td> 
                    <td>7</td>
                    <td>@currency(250000)</td>
                    <td class="text-center"><a href=""><div class="btn btn-primary">Print</div></a></td>
                </tr>
                <tr class="align-middle">
                    <td>1</td>
                    {{-- <td>{{ $loop->iteration }}</td> --}}

                    <td>12-4-2025</td> 
                    <td>7</td>
                    <td>@currency(250000)</td>
                    <td class="text-center"><a href=""><div class="btn btn-primary">Print</div></a></td>
                </tr>
                <tr class="align-middle">
                    <td>1</td>
                    {{-- <td>{{ $loop->iteration }}</td> --}}

                    <td>12-4-2025</td> 
                    <td>7</td>
                    <td>@currency(250000)</td>
                    <td class="text-center"><a href=""><div class="btn btn-primary">Print</div></a></td>
                </tr>
                {{-- Loop here --}}
            </table>
        </div>
    </div>
@endsection