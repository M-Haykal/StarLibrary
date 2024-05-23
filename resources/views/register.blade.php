@extends("layouts.main_register")
@section('main_register')
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
            <div class="card text-black m-3" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                            <form class="mx-1 mx-md-4" role="form text-left" action="{{ route('register_user') }}" method="POST" onsubmit="return validatePassword()">
                                @csrf
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="nama">Your Name</label>
                                        <input type="text" id="nama" name="nama" placeholder="Name" aria-label="Name" aria-describedby="name-addon" class="form-control" required />
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="email">Your Email</label>
                                        <input type="email" id="email" name="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon" class="form-control" required />
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon" class="form-control" required />
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="confirm_password">Repeat your Password</label>
                                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat Password" aria-label="Confirm Password" aria-describedby="confirm-password-addon" class="form-control" required />
                                    </div>
                                </div>

                                <div class="form-check d-flex justify-content-center mb-5">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="terms" required />
                                    <label class="form-check-label" for="terms">
                                        I agree all statements in <a href="#!">Terms of service</a>
                                    </label>
                                </div>

                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg">Register</button>
                                </div>

                            </form>

                        </div>
                        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function validatePassword() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;
    if (password !== confirm_password) {
        toastr.error("Passwords do not match.");
        return false;
    }
    return true;
}
</script>
@endpush
