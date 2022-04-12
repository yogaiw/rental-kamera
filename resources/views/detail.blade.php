<html>
    <head>
        <title>Detail - {{ $detail->nama_alat }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-arrow-left"></i> <a href="{{ url()->previous() }}" class="stretched-link link-dark">Kembali</a></div>
                        <img src="{{ url('') }}/images/{{ $detail->gambar }}" alt="">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">@money( $detail->harga24 )<span class="badge bg-light text-dark" style="float: right;">24 Jam</span></li>
                            <li class="list-group-item">@money( $detail->harga12 )<span class="badge bg-light text-dark" style="float: right;">12 Jam</span></li>
                            <li class="list-group-item">@money( $detail->harga6 )<span class="badge bg-light text-dark" style="float: right;">6 Jam</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 mb-4">
                    <div class="card h-100">
                        <div class="card-header"><b>Detail Info</b></div>
                        <div class="card-body">
                            <h4><span class="badge bg-warning">{{ $detail->category->nama_kategori }}</span></h4>
                            <h1><b>{{ $detail->nama_alat }}</b></h1>
                            <p class="text-muted">Deskripsi menyusul</p>
                            <hr>
                            <h6><i>Daftar Pinjaman Mendatang</i></h6>
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Tanggal Keluar</th>
                                    <th>Durasi Pinjaman</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>misal</td>
                                    <td>misal</td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                        @if (Auth::check())
                            <div class="card-body">
                                <form action="{{ route('cart.store',['id' => $detail->id]) }}" method="POST">
                                    @csrf
                                    <div class="d-grid gap-2 d-md-block">
                                        <button type="submit" class="btn btn-sm btn-success" name="btn" value="24"><i class="fas fa-shopping-cart"></i> @money($detail->harga24) <b>24jam</b></button>
                                        <button type="submit" class="btn btn-sm btn-success" name="btn" value="12"><i class="fas fa-shopping-cart"></i> @money($detail->harga12) <b>12jam</b></button>
                                        <button type="submit" class="btn btn-sm btn-success" name="btn" value="6"><i class="fas fa-shopping-cart"></i> @money($detail->harga6) <b>6jam</b></button>
                                    </div>
                                </form>
                                <small>Telah login sebagai {{ Auth::user()->name }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
