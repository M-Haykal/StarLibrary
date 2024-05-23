<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ route("dashboard_petugas") }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>StarPerpus</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="../assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->nama }}</h6>
                <span>Petugas</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route("dashboard_petugas") }}" class="nav-item nav-link{{ Route::is('dashboard_petugas') ? ' active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route("panel_buku_petugas") }}" class="nav-item nav-link{{ Route::is('panel_buku_petugas') ? ' active' : '' }}"><i class="fa fa-book me-2"></i>Buku Manager</a>
            <a href="{{ route("panel_buku_online") }}" class="nav-item nav-link{{ Route::is('panel_buku_online') ? ' active' : '' }}"><i class="fa fa-book me-2"></i>Online Manager</a>
            <a href="{{ route("panel_peminjaman_petugas") }}" class="nav-item nav-link{{ Route::is('panel_peminjaman_petugas') ? ' active' : '' }}"><i class="fa fa-keyboard me-2"></i>List Peminjaman</a>
            <a href="{{ route("panel_kategori_petugas") }}" class="nav-item nav-link{{ Route::is('panel_kategori_petugas') ? ' active' : '' }}"><i class="fa fa-list-alt"></i>Kategori</a>
        </div>
    </nav>
</div>
x
