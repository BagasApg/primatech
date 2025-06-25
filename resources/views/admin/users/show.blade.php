
@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">User Detail</h1>
    <div class="col-md-10">

        <div class="actions d-flex justify-content-evenly align-items-middle col-md-1 gap-2 mb-2">

            <form action="{{ route('admin.user.delete', $user->user->id) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger"><i data-feather="trash-2"></i></button>
            </form>

        </div>

        <div class="mb-3">
            <p class="fs-5 m-0">Username</p>
            <p class="fs-4 fw-bold">{{ $user->user->name }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">Date of Birth</p>
            <p class="fs-4 fw-bold">{{ $user->date_of_birth }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">Gender</p>
            <p class="fs-4 fw-bold">{{ $user->gender }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">Address</p>
            <p class="fs-4 fw-bold">{{ $user->address }}</p>
        </div>

        <div class="mb-3">
            <p class="fs-5 m-0">Province</p>
            <p class="fs-4 fw-bold">{{ $province[0]->nama }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">City</p>
            <p class="fs-4 fw-bold">{{ $city[0]->nama }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">Contact</p>
            <p class="fs-4 fw-bold">{{ $user->contact }}</p>
        </div>
        <div class="mb-3">
            <p class="fs-5 m-0">Paypal ID</p>
            <p class="fs-4 fw-bold">{{ $user->paypal_id }}</p>
        </div>

        
        <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
