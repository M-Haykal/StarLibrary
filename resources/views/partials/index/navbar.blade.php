<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
    </form>
    <div class="navbar-nav align-items-center ms-auto">

        <div class="nav-item dropdown">
            @guest
            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                <span class="d-none d-lg-inline-flex">Sign In</span>
            </a>
            @else
            <form id="logout-form" method="POST" action="{{ route('logout_user') }}">
                @csrf
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="d-none d-lg-inline-flex">Log Out</span>
                </a>
            </form>
            @endguest
        </div> 

    </div>
</nav>
