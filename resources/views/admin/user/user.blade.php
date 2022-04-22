@extends('admin.main')
@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col col-lg-6 col-md-12">
            <div class="card shadow mt-4">
                <div class="card-header"><b>Penyewa</b></div>
                <div class="card-body">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyewa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }} <span class="badge bg-secondary">{{ $item->payment->count() }} Transaksi</span></td>
                                <td>{{ $item->telepon }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col col-lg-6 col-md-12">
            <div class="card shadow mt-4">
                <div class="card-header"><b>Admin</b></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
