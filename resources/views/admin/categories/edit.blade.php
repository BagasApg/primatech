@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Edit {{ $category->name }} Category</h1>

    <form action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('put')
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name"
                    class="form-control 
                    @error('name')
                    is-invalid
                    @enderror"
                    value="{{ old('name', $category->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit Category</button>
        </div>
    </form>
@endsection
