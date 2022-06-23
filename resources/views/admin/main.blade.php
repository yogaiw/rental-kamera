<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Area - Kancil Rental Kamera</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="/css/adminstyles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('admin.index') }}">Admin Area</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">

                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('akun.pengaturan') }}">Pengaturan Akun</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">Manajemen Reservasi</div>
                            <button type="button" class="btn btn-success nav-link" data-bs-toggle="modal" data-bs-target="#cetakLaporanModal">
                                <i class="fas fa-print"></i> &nbsp; Cetak Laporan
                            </button>
                            <a class="nav-link {{ Route::is('penyewaan.index') ? 'active' : '' }}" href="{{ route('penyewaan.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Reservasi
                            </a>
                            <a class="nav-link {{ Route::is('riwayat-reservasi') ? 'active' : '' }}" href="{{ route('riwayat-reservasi') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Riwayat Reservasi
                            </a>
                            <div class="sb-sidenav-menu-heading">Manajemen Penyewa</div>
                            <a class="nav-link {{ Route::is('admin.user') ? 'active' : '' }}" href="{{ route('admin.user') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                                Daftar Penyewa
                            </a>
                            @if (Auth::user()->role == 2)
                                <a class="nav-link {{ Route::is('superuser.admin') ? 'active' : '' }}" href="{{ route('superuser.admin') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                                    Manajemen Admin
                                </a>
                            <div class="sb-sidenav-menu-heading">Manajemen Alat</div>
                            <a class="nav-link {{ Route::is('alat.index') ? 'active' : '' }}" href="{{ route('alat.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Alat
                            </a>
                            <a class="nav-link {{ Route::is('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kategori
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                @yield('content')
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Kancil Rental Kamera Purwokerto</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <div class="modal fade" id="cetakLaporanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('cetak') }}" method="GET" target="_blank">
                            <label class="form-label">Dari</label>
                            <input type="date" class="form-control mb-4" name="dari">
                            <label class="form-label">Sampai</label>
                            <input type="date" class="form-control mb-4" name="sampai">
                            <button type="submit" class="btn btn-success"><i class="fas fa-print"></i>  Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/js/adminscripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="/js/datatables.js"></script>
    </body>
</html>
