<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <style>
        @font-face {
            /* font-family: "Nunito";
            src: url('{{ storage_path('fonts/Nunito-Regular.ttf') }}') format("truetype"); */
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            /* font-family: "Nunito";
            src: url('{{ storage_path('fonts/Nunito-Regular.ttf') }}') format("truetype"); */
            font-weight: bold;
            font-style: normal;
        }

        * {
            font-family: "Nunito";
            padding: 0;
            margin: 0;
        }

        h1 {
            margin-bottom: -1rem;
        }

        .container {
            width: 210mm;
            height: 297mm;
            /* padding: 1rem 1.5rem; */
        }

        .inner-container {
            padding: 1rem 0;
        }

        .title {
            text-align: center;
        }

        .user-information {
            margin-top: 1rem;
        }

        .user-information table {
            /* border: solid 1px black; */
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
        }



        .user-information table tr * {
            padding: 0 0.5rem;
            /* border: solid 1px black; */
        }

        .user-information table tr td:nth-child(odd) {
            /* text-align: right; */
            width: 15%;
        }

        .user-information table tr td:nth-child(even) {}

        .purchases {
            margin-top: 2rem;
        }

        .purchases p {
            width: 85%;
            margin: 0 auto;
        }

        .purchases p span {
            text-decoration: underline;
        }

        .purchases-table {
            width: 90%;
            margin: 0 auto;
        }

        .purchases-table,
        .purchases-table tr th,
        .purchases-table tr td {
            border: solid 1px black;
            border-collapse: collapse;
            padding: 0 1rem;

        }

        .sign {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 2rem;
        }

        .store-sign {
            width: 30%;
            margin: 0 0 0 auto;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="inner-container">

            <div class="title">
                <div>
                    <h1>Toko Alat Kesehatan</h1>
                    <h2>Laporan Belanja Anda</h2>
                </div>
            </div>

            <div class="user-information">
                <table>
                    <tr>
                        <td>User ID</td>
                        <td>{{ $user->id }}</td>
                        <td>Tanggal</td>
                        <td>{{ $order->order_date }}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>{{ $user->name }}</td>
                        <td>ID Paypal</td>
                        <td>{{ $user->profile->paypal_id }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $user->profile->address }}</td>
                        {{-- <td>Nama Bank</td>
                        <td>{{ $bank }}</td> --}}
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>{{ $user->profile->phone }}</td>
                        {{-- <td>Cara Bayar</td>
                        <td>{{ $payment ? 'Prepaid' : 'Postpaid' }}</td> --}}
                    </tr>
                </table>
            </div>

            <div class="purchases">
                <table class="purchases-table">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk dengan ID</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>

                    @foreach ($order_details as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>@currency($item->total_price)</td>
                        </tr>
                    @endforeach
                </table>
                <p>Total belanja: <span>@currency($order->grand_total)</span></p>
            </div>

            <div class="sign">
                <div class="store-sign">
                    <p>TANDATANGAN TOKO</p>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
