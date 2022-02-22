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
                        <li class="nav-item"><a class="nav-link" href="#login">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section id="katalog">
            <div class="container px-2">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="card mb-4">
                            <div class="card-header">
                                <p style="float: left">Lihat Katalog</p>
                                <p style="float: right"><a class="link-dark" href="#login">Login</a> untuk penyewaan secara online</p>
                            </div>
                            <div class="card-body">
                                <div class="btn-group mb-4" role="group" aria-label="Basic example">
                                    <a href="/" class="btn btn-success">Semua</a>
                                    @foreach ($categories as $cat)
                                    <a href="?kategori={{ $cat->id }}" class="btn btn-primary">{{ $cat->nama_kategori }}</a>
                                    @endforeach
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
                                <div class="row row-cols-md-2 row-cols-lg-6 g-4">
                                    @foreach ($alats as $alat)
                                    <div class="col">
                                        <div class="card h-100">
                                            <img src="/images/noimage.jpg" class="card-img-top" alt="...">
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

                        <div class="card mb-4" id="login">
                            <div class="card-header">Login</div>
                            <div class="card-body">
                                @include('partials.login')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
