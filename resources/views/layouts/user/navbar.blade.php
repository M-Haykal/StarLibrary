<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StarLibrary</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/pplg.png') }}">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="{{ route('index') }}" data-toggle="tooltip" data-placement="top"><i
                    class="bi bi-star">StarLibrary</i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-lg-0">
                    <li class="nav-item fs-6">
                        <a class="nav-link active text-white" href="#home">Home</a>
                    </li>
                    <li class="nav-item fs-6">
                        <a class="nav-link active text-white" href="#about">About Us</a>
                    </li>
                    <li class="nav-item fs-6">
                        <a class="nav-link active text-white" href="#category">Category</a>
                    </li>
                    <li class="nav-item fs-6">
                        <a class="nav-link active text-white" href="#book">Book</a>
                    </li>
                </ul>
                <div class="search-box">
                    <form class="link d-flex" role="search">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <a class="navbar-brand" href="../view/profile.html">
                                    <img src="https://i.pinimg.com/236x/ad/73/1c/ad731cd0da0641bb16090f25778ef0fd.jpg"
                                        alt="Avatar Logo" style="width: 30px" class="rounded-pill" />
                                </a>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('borrowing') }}">Borrowing list</a></li>
                                <li><a class="dropdown-item" href="{{ route('favorite') }}">Favorite</a></li>
                                <li><a class="dropdown-item" href="">Log Out</a></li>
                            </ul>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-body-tertiary text-center text-lg-start">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-body" href="https://github.com/M-Haykal/">HayyProject</a>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
