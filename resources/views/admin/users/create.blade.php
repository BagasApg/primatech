@extends('layouts.admin')

@section('content')

<h1 class="mb-4">Add New User</h1>
    <div class="col-md-4">

        <form method="POST" action="{{ route('admin.user.store') }}">
            @csrf
            <div class="row mb-3">
                <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>

                <div class="col-md-7">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-7">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Retype
                    Password</label>

                <div class="col-md-7">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="col-md-7">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="DOB" class="col-md-4 col-form-label text-md-end">
                    Date of Birth
                </label>
                <div class="col-md-7">
                    <input type="date" name="DOB" id="DOB"
                        class="form-control @error('DOB') is-invalid @enderror" value="{{ old('DOB') }}" required
                        autocomplete="DOB">
                </div>

                @error('DOB')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="gender" class="col-md-4 col-form-label text-md-end">Gender</label>
                <div class="col-md-7 d-flex align-items-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male">
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>

                </div>
            </div>

            <div class="row mb-3">
                <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                <div class="col-md-7">
                    <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="province_id" class="col-md-4 col-form-label text-md-end">Province</label>
                <div class="col-md-7">
                    <select name="province_id" id="province_id" class="form-select">

                        {{-- LIST PROVINSI --}}
                        <option selected>Choose Province</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->kode }}">{{ $province->nama }}</option>
                        @endforeach
                        {{-- LIST PROVINSI --}}

                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="city_id" class="col-md-4 col-form-label text-md-end">City</label>
                <div class="col-md-7">
                    <select name="city_id" id="city_id" class="form-select">

                        {{-- LIST KOTA --}}

                        <option selected>Choose City</option>

                        {{-- LIST KOTA --}}

                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="contact" class="col-md-4 col-form-label text-md-end">Contact No.</label>
                <div class="col-md-7">
                    <input type="tel" name="contact" id="contact" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label for="paypal" class="col-md-4 col-form-label text-md-end">Paypal ID</label>
                <div class="col-md-7">
                    <input type="tel" name="paypal" id="paypal" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
    </div>
    <script>
        $(document).ready(function() {
            $("#province_id").change(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const province_id = $("#province_id").val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.user.province') }}",
                    data: {
                        province_id: province_id
                    },
                    cache: false,

                    success: function(response) {
                        $("#city_id").html(response);
                    },
                    error: function(data) {
                        console.error(data);
                    }
                });

            });
        })
    </script>
@endsection
