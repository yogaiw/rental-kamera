<!DOCTYPE html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="login" method="POST">
        @csrf
        <input type="email" name="email" id="email">
        <input type="password" name="password" id="password">
        <button type="submit">
            {{ __('Login') }}
        </button>
    </form>
</body>
