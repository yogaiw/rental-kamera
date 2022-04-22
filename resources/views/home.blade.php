<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kancil Rental Kamera Purwokerto</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href="/">Kancil Rental Kamera</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        @if (!Auth::check())
                            <li class="nav-item"><a class="nav-link" href="#login">Login</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <section id="katalog">
            <div class="container px-2">
                <div class="row justify-content-center">
                    @if (session()->has('registrasi'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('registrasi') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Auth::check() && Auth::user()->isAdmin == false)
                        <div class="alert alert-warning" role="alert">
                            Anda telah login sebagai <b>{{ Auth::user()->name }}</b>&nbsp; <a class="btn btn-success" href="{{ route('member.index') }}">Mulai Menyewa</a>
                        </div>
                    @elseif (Auth::check() && Auth::user()->isAdmin == true)
                        <div class="alert alert-warning" role="alert">
                            Anda telah login sebagai Admin(<b>{{ Auth::user()->name }}</b>)&nbsp; <a class="btn btn-success" href="{{ route('admin.index') }}">Halaman Admin</a>
                        </div>
                    @endif
                    <div class="col-lg-11">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                @if (!Auth::check())
                                    <a class="link-dark" href="#login">Login</a> untuk penyewaan secara online
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="dropdown mb-4">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                      Kategori
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="{{ route('home') }}">Semua</a></li>
                                        @foreach ($categories as $cat)
                                        <li><a class="dropdown-item" href="?kategori={{ $cat->id }}">{{ $cat->nama_kategori }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <form action="">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" width="25%" placeholder="Cari Alat" name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body" style="max-height: 500px; overflow:scroll;">
                                <div class="row row-cols-sm-2 row-cols-lg-6 g-2">
                                    @foreach ($alats as $alat)
                                    <div class="col-6">
                                        <div class="card h-100">
                                            <img src="{{ url('') }}/images/{{ $alat->gambar }}" alt="">
                                            <div class="card-body">
                                                <span class="badge bg-warning">{{ $alat->category->nama_kategori }}</span>
                                                <h6 class="card-title">{{ $alat->nama_alat }}</h6>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">@money($alat->harga24)<span class="badge bg-light text-dark" style="float: right;">24 Jam</span></li>
                                                <li class="list-group-item">@money($alat->harga12)<span class="badge bg-light text-dark" style="float: right;">12 Jam</span></li>
                                                <li class="list-group-item">@money($alat->harga6)<span class="badge bg-light text-dark" style="float: right;">6 Jam</span></li>
                                            </ul>
                                            <div class="card-footer">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('home.detail',['id' => $alat->id]) }}" class="btn btn-sm btn-primary">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if (!Auth::check())
                            <div class="card shadow mb-4" id="login">
                                <div class="card-header">Login</div>
                                <div class="card-body">
                                    @include('partials.login')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">&copy; 2022 Kancil Rental Kamera</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
