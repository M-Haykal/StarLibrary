<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Perpustakaan</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="../assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->nama }}</h6> <!-- Menggunakan nama siswa yang sedang masuk -->
    <span>Costumer</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard_costumer') }}" class="nav-item nav-link{{ Route::is('dashboard_costumer') ? ' active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('data.peminjaman') }}" class="nav-item nav-link{{ Route::is('data.peminjaman') ? ' active' : '' }}"><i class="fa fa-th me-2"></i>Data peminjaman</a>


        </div>
    </nav>
</div>
