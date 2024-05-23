@extends('layouts.main_login')
@section('login_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 text-black mt-5">
            <div class="px-5 ms-xl-4 d-flex justify-content-center">
                <h1><i class="bi bi-star">StarLibrary</i></h1>
            </div>


            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                <form style="width: 23rem;" role="form" method="POST" action="{{ route('login_user') }}">
    @csrf <!-- Include CSRF token -->
                    <h3 class=" mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="form2Example18">Email address</label>
                        <input type="email" id="floatingInput" placeholder="name@example.com" name="email" class="form-control form-control-md" />

                    </div>
                    <div data-mdb-input-init cl ass="form-outline">
                        <label class="form-label" for="form2Example28">Password</label>
                        <input type="password" id="floatingPassword" placeholder="Password" name="password" class="form-control form-control-md" />
                        <label ></label>
                    </div>
                    {{-- <div data-mdb-input-init class="form-outline">
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" name="login_as">

                            <option value="admin">Admin</option>
                            <option value="petugas">Officers</option>
                            <option value="costumer" selected>Customer</option>
                        </select>
                    </div> --}}
                    <div class="pt-1 mb-4 mt-3">
                        <button data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-success btn-lg btn-block text-white" type="submit">Login</button>
                    </div>

                    <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                    <p>Don't have an account? <a href="{{ route('register')}}" class="link-info">Register here</a></p>
                </form>
            </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
            <img src="https://i.pinimg.com/564x/28/a5/38/28a53818427467bceef016911ed494b4.jpg"
                alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
    </div>
</div>
@endsection
