@extends('layouts.admin')

@section('content')
    <h1>Users</h1>
    <div class="col-md-8">

        @if(session()->has('success'))
        <div class="alert alert-success m-0">
            {{ session('success') }}
        </div>
        @endif
        
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary my-3">Add New User</a>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th class="w-25">Email</th>
                <th class="w-25">Contact</th>
                <th>Actions</th>
            </tr>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->user->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->contact }}</td>

                    <td>
                        <div class="actions d-flex justify-content-evenly align-items-middle">
                            <a href="{{ route('admin.user.show', $u->id) }}" class="btn btn-primary"><i
                                    data-feather="eye"></i></a>

                            <form action="{{ route('admin.user.delete', $u->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger"><i data-feather="trash-2"></i></button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
