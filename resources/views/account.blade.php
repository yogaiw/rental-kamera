<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <title>Pengaturan Akun</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href="{{ route('home') }}">Pengaturan Akun</a>
            </div>
        </nav>
        <div class="container mt-4 px-3">
            @if (session('updated'))
                <div class="alert alert-success">{{ session('updated') }}</div>
            @endif
            @if (session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
            @endif
            <div class="row justify-content-center text-center mb-4">
                <h5>Pengaturan Akun</h5>
            </div>
            <div class="row justify-content-center">
                <div class="col col-md-5">
                    <form action="{{ route('akun.update') }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-floating mb-1">
                            <input type="text" name="name" class="form-control" id="floatingName" value="{{ $user->name }}" required>
                            <label for="floatingName">Nama Lengkap</label>
                        </div>
                        <div class="form-floating mb-1">
                            <input type="email" name="email" class="form-control" id="floatingInput" value="{{ $user->email }}" required>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="telepon" class="form-control" id="floatingtelp" value="{{ $user->telepon }}" required>
                            <label for="floatingtelp">No Telepon</label>
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-4">Simpan</button>
                    </form>
                    <h5 class="mt-4">Ganti Password</h5>
                    <form action="{{ route('changepassword') }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-floating mb-1">
                            <input type="password" name="oldPassword" class="form-control" id="floatingOld" required>
                            <label for="floatingOld">Password Saat Ini</label>
                        </div>
                        <div class="form-floating mb-1">
                            <input type="password" name="newPassword" class="form-control" id="floatingNew" required>
                            <label for="floatingNew">Password Baru</label>
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-4">Ganti Password</button>
                    </form>
                    @if (Auth::user()->role != 0)
                    <a class="btn btn-danger w-100 mt-2" href="{{ route('admin.index') }}">Kembali</a>
                    @else
                    <a class="btn btn-danger w-100 mt-2" href="{{ route('member.index') }}">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
