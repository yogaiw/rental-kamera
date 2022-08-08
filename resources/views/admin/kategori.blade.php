@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Kategori</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tambah Kategori
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Kategori Baru" required>
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary d-flex fa-pull-right">Tambah</button></a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Kategori
                    </div>
                    <div class="card-body">
                        <table id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Alat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cat->nama_kategori }}</td>
                                    <td> {{ $cat->alat->count() }}</td>
                                    <td>
                                        <a href="{{ route('kategori.edit',['id'=>$cat->id]) }}" type="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('kategori.destroy',['id'=>$cat->id]) }}" method="POST" style="display: inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="javascript: return confirm('Anda yakin akan menghapus alat ini?');"><i class="fas fa-trash"></i></a>
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
