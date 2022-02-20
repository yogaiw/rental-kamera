@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Alat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Manajemen Alat</li>
        </ol>
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header">
                        Alat
                    </div>
                    <div class="card-body">
                        <a href="" class="btn btn-primary mb-4">Tambah Alat</a>
                        <div class="dropdown" style="float: right;">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                              Filter Kategori
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('alat.index') }}">Semua</a></li>
                                @foreach ($categories as $cat)
                                <li><a class="dropdown-item" href="{{ route('alat.index',['id'=>$cat->id]) }}">{{ $cat->nama_kategori }}</a></li>
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
                        <div class="row row-cols-2 row-cols-md-6 g-4">
                            @foreach ($alats as $alat)
                            <div class="col">
                                <div class="card">
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
                                    <div class="card-body">
                                        <div class="btn-group" role="group">
                                            <a href="" class="btn btn-sm btn-primary">Detail</a>
                                            <a href="" class="btn btn-sm btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Alat
                    </div>
                    <div class="card-body">
                        <table id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Alat</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alats as $alat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td></td>
                                    <td> {{ $alat->nama_alat }} </td>
                                    <td> {{ $alat->category->nama_kategori }} </td>
                                    <td>
                                        <a href="" type="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <form action="" method="POST" style="display: inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
