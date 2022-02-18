@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Alat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Manajemen Alat</li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Alat
                    </div>
                    <div class="card-body">
                        <a href="" class="btn btn-primary mb-4">Tambah Alat</a>
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
                                    <td> {{ $alat->nama_kategori }} </td>
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
