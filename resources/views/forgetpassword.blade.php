<html>
    <head>
        <title>Lupa Password</title>
    </head>
    <body>
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ route('forgetpassword.sendlink') }}" method="POST">
            @csrf
            <input type="text" name="email">
            <button type="submit">Reset Password</button>
        </form>
    </body>
</html>
