@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Orders</h1>

    <div class="col-md-8">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Order ID</th>
                <th class="w-25">Date</th>
                <th>Qty.</th>
                <th class="w-25">Grand Total</th>
                <th class="w-25">Actions</th>
            </tr>
            <tr>
                <td>1</td>
                <td>ORDER-120912</td>
                <td>12-5-2025</td>
                <td>2</td>
                <td>Rp50.000</td>
                <td><button class="btn btn-success">Approve</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>ORDER-12128</td>
                <td>12-5-2026</td>
                <td>2</td>
                <td>Rp70.000</td>
                <td><button class="btn btn-success">Ship</button></td>
            </tr>
        </table>
    </div>
@endsection
