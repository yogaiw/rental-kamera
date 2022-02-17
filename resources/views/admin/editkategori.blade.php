@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4">Edit Untuk Kategori "{{ $kategori->nama }}"</h1>
        <div class="row">
            <form action="{{ route('kategori.update',['id'=>$kategori->id]) }}" method="POST">
                @method('PATCH')
                @csrf
                <input type="text" name="nama" class="form-control mb-4" width="30%" value="{{ $kategori->nama }}" required>
                <button type="submit" class="btn btn-primary">Ganti Nama</button>
            </form>
        </div>
    </div>
</main>
@endsection
