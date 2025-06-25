@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Create New Product</h1>

    <form action="{{ route('admin.product.store') }}" enctype="multipart/form-data" method="post">
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

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" id="category" class="form-select">
                    @foreach ($categories as $c)
                        @if (old('category_id') == $c->id)
                            <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                        @else
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endif
                    @endforeach
                </select>

            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea name="description" id="desc" cols="30" rows="5"
                    class="form-control

                @error('description')
                    is-invalid
                @enderror 
                
                ">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input
                    class="form-control
                
                @error('price')
                    is-invalid
                @enderror 
                
                "
                    min="0" type="number" name="price" id="price" value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <img src="" alt="" class="col-md-4 d-block img-preview img-fluid mb-3">
                <input type="file" name="image" id="image"
                    class="form-control
                
                @error('image') 
                is-invalid
                @enderror
                
                "
                    onchange="previewImage()" required>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>
@endsection
