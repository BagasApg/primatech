@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Product Detail</h1>
    <div class="col-md-10">

        <div class="actions d-flex justify-content-evenly align-items-middle col-md-1 gap-2 mb-2">
            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning"><i data-feather="edit"></i></a>

            <form action="{{ route('admin.category.delete', $category->id) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger"><i data-feather="trash-2"></i></button>
            </form>

        </div>

        <div class="mb-3">
            <p class="fs-5 m-0">Category Name</p>
            <p class="fs-4 fw-bold">{{ $category->name }}</p>
        </div>
        <div class="mb-4">
            <p class="fs-5 m-0">Products with this category</p>
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                @foreach ($products as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->price }}</td>
                        <td><a class="btn btn-primary" href="{{ route('admin.product.show', $p->id) }}"><i
                                    data-feather="eye"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
