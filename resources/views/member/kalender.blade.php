@extends('member.main')
@section('container')
<div class="container">
    <div class="alert alert-primary">Menampilkan jadwal alat yang sedang disewakan</div>
    <div class="card shadow">
        <div class="card-body">
            @include('partials.kalender')
        </div>
    </div>
</div>
@endsection
