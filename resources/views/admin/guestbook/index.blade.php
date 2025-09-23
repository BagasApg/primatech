@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Guestbook</h1>

    <div class="col-md-8">
        <table class="table">
            <tr>
                <td>#</td>
                <td>Sender</td>
                <td>Message</td>
                <td>Date</td>
                <td></td>
            </tr>
            @foreach ($gbooks as $gbook)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $gbook->sender }}</td>
                    <td>{{ $gbook->message }}</td>
                    <td>{{ $carbon::parse($gbook->date) }}</td>
                    <td>
                        <form action="{{ route('admin.guestbook.delete', $gbook->id) }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger"><i data-feather="trash-2"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
