@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card bg-white p-2">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-4 d-flex justify-content-center">
                                <div class="card col-md-7">
                                    <div class="card-body px-0 py-2">
                                        <div class="text-center">FORM REGISTRASI</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>

                                <div class="col-md-7">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-7">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

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
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-7">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

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
                                        class="form-control @error('DOB') is-invalid @enderror" value="{{ old('DOB') }}"
                                        required autocomplete="DOB">
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
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                            value="male">
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="female">
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
                                <label for="city" class="col-md-4 col-form-label text-md-end">City</label>
                                <div class="col-md-7">
                                    <select name="city" id="city" class="form-select">

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

                            <div class="row mb-0">
                                <div class="col-md-8 d-flex justify-content-center w-100">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                                <div class="d-flex justify-content-center w-100 pt-3 ">
                                    <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                console.log(province_id)

                $.ajax({
                    type: "POST",
                    url: "{{ route('register.province') }}",
                    data: {
                        province_id: province_id
                    },
                    cache: false,

                    success: function(response) {
                        $("#city").html(response);
                    },
                    error: function(data) {
                        console.error(data);
                    }
                });

            });
        })
    </script>
@endsection
