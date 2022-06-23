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
                            <li class="nav-item"><a class="nav-link" href="{{ route('daftar') }}">Daftar</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <section id="katalog">
            <div class="container">
                <div class="row justify-content-center">
                    @if (session()->has('registrasi'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('registrasi') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Auth::check() && Auth::user()->role == 0)
                        <div class="alert alert-warning" role="alert">
                            Anda telah login sebagai <b>{{ Auth::user()->name }}</b>&nbsp; <a class="btn btn-success" href="{{ route('member.index') }}">Mulai Menyewa</a>
                        </div>
                    @elseif (Auth::check() && Auth::user()->role != 0)
                        <div class="alert alert-warning" role="alert">
                            Anda telah login sebagai Admin(<b>{{ Auth::user()->name }}</b>)&nbsp; <a class="btn btn-success" href="{{ route('admin.index') }}">Halaman Admin</a>
                        </div>
                    @endif
                    <div class="col-lg-11">
                        <div class="card mb-4">
                            <div class="card-body">
                                @if (!Auth::check())
                                    <a class="link-dark" href="#login">Login</a> untuk penyewaan secara online
                                @endif
                                <div class="d-flex w-100 justify-content-start mb-4 mt-2" style="overflow: auto">
                                    <div class="btn-group" role="group">
                                        <a class="btn {{ (request('kategori') == null) ? 'btn-secondary' : 'btn-outline-secondary' }}" href="{{ route('member.index') }}">Semua</a>
                                        @foreach ($categories as $cat)
                                            <a class="btn {{ (request('kategori') == $cat->id) ? 'btn-secondary' : 'btn-outline-secondary' }}" href="?kategori={{ $cat->id }}">{{ $cat->nama_kategori }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" width="25%" placeholder="Cari Alat" name="search" {{ (request()->get('search') != null) ? "value = ".request()->get('search')."" : "" }}>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body" style="max-height: 500px; overflow:auto;">
                                <div class="row row-cols-sm-2 row-cols-lg-6 g-2">
                                    @foreach ($alats as $alat)
                                    <div class="col-6">
                                        <div class="card h-100">
                                            <img class="card-img-top" src="{{ url('') }}/images/{{ $alat->gambar }}" alt="">
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
                                                    <a href="{{ route('home.detail',['id' => $alat->id]) }}" class="btn btn-sm btn-secondary">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if (!Auth::check())
                            <div class="card mb-4" id="login">
                                <div class="card-body">
                                    <div class="d-md-flex d-sm-block justify-content-around">
                                        <div class="text-center my-auto">
                                            <h5 class="fw-bold mb-3">Nikmati kemudahan dalam melakukan reservasi</h5>
                                            <a href="{{ route('daftar') }}" class="btn btn-success mb-4">Daftar Sekarang</a>
                                        </div>
                                        <div>
                                            @include('partials.login')
                                        </div>
                                    </div>
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
