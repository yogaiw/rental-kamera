<!DOCTYPE html>
<html>
    <head>
        <title>Lupa Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center mt-5">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <a href="{{ route('home') }}" class="btn-link mb-3">kembali ke halaman utama</a>
                <form action="{{ route('forgetpassword.sendlink') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control mb-3" name="email" placeholder="Masukkan email anda" required>
                    <button class="btn btn-success" type="submit">Kirim link reset password</button>
                </form>
            </div>
        </div>
    </body>
</html>
