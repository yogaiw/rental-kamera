@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i></a>
        <h1 class="mt-4 mb-4">Edit Untuk Kategori "{{ $kategori->nama_kategori }}"</h1>
        <div class="row">
            <form action="{{ route('kategori.update',['id'=>$kategori->id]) }}" method="POST">
                @method('PATCH')
                @csrf
                <input type="text" name="nama" class="form-control mb-4" width="30%" value="{{ $kategori->nama_kategori }}" required>
                <button type="submit" class="btn btn-primary">Ganti Nama</button>
            </form>
        </div>
    </div>
</main>
@endsection
