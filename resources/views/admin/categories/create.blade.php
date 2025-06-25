@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Create New Category</h1>

    <form action="{{ route('admin.category.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name"
                    class="form-control 
                    @error('name')
                    is-invalid
                    @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>
@endsection
