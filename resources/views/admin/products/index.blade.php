@extends('layouts.admin')

@section('content')
    <h1>Products</h1>

    <div class="col-md-8">

        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ $session('success') }}
        </div>
        @endif
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary my-3">
            Create New Product
        </a>

        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th class="w-25">Price</th>
                <th class="w-25">Actions</th>
            </tr>
            @foreach ($products as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->name }}</td>
                    <td>@currency($p->price)</td>
                    <td>
                        <div class="actions d-flex justify-content-evenly align-items-middle">
                            <a href="{{ route('admin.product.show', $p->id) }}" class="btn btn-primary"><i
                                    data-feather="eye"></i></a>

                            <a href="{{ route('admin.product.edit', $p->id) }}" class="btn btn-warning"><i
                                    data-feather="edit"></i></a>

                            <form action="{{ route('admin.product.delete', $p->id) }}" method="post">
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
