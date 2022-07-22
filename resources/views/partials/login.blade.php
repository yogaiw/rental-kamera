<form action="login" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary">Login</button>
        <a class="btn btn-link link-dark" href="{{ route('forgetpassword.index') }}">Lupa Password</a>
    </div>
</form>
