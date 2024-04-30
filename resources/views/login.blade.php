<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/pplg.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");

        body {
            font-family: "Merriweather", serif;
            font-weight: 400;
            font-style: normal;
        }

        ::-webkit-scrollbar {
            width: 0px;
            height: 0px;
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black mt-5">
                    <div class="px-5 ms-xl-4 d-flex justify-content-center">
                        <h1><i class="bi bi-star">StarLibrary</i></h1>
                    </div>
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form style="width: 23rem;">
                            <h3 class=" mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
                            <div data-mdb-input-init class="form-outline">
                                <input type="email" id="form2Example18" class="form-control form-control-md" />
                                <label class="form-label" for="form2Example18">Email address</label>
                            </div>
                            <div data-mdb-input-init class="form-outline">
                                <input type="password" id="form2Example28" class="form-control form-control-md" />
                                <label class="form-label" for="form2Example28">Password</label>
                            </div>
                            <div data-mdb-input-init class="form-outline">
                                <select class="form-select form-select-sm" aria-label="Default select example">
                                    <option selected>Login As</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Officers</option>
                                    <option value="3">Customer</option>
                                </select>
                            </div>
                            <div class="pt-1 mb-4 mt-3">
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-success btn-lg btn-block text-white" type="button">Login</button>
                            </div>
                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                            <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="https://i.pinimg.com/564x/28/a5/38/28a53818427467bceef016911ed494b4.jpg"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
