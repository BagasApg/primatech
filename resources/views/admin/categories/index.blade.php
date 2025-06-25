@extends('layouts.admin')

@section('content')
    <h1>Categories</h1>
    <div class="col-md-8">

        @if(session()->has('success'))
        <div class="alert alert-success m-0">
            {{ session('success') }}
        </div>
        @endif
        
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary my-3">Add New Category</a>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th class="w-25">Products</th>
                <th class="w-25">Actions</th>
            </tr>
            @foreach ($categories as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->products_count }}</td>

                    <td>
                        <div class="actions d-flex justify-content-evenly align-items-middle">
                            <a href="{{ route('admin.category.show', $c->id) }}" class="btn btn-primary"><i
                                    data-feather="eye"></i></a>

                            <a href="{{ route('admin.category.edit', $c->id) }}" class="btn btn-warning"><i
                                    data-feather="edit"></i></a>

                            <form action="{{ route('admin.category.delete', $c->id) }}" method="post">
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
