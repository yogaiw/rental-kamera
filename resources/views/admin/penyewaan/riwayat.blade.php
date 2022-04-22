@extends('admin.main')
@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="alert alert-warning">Ini merupakan halaman yang menampilkan reservasi yang sudah selesai</div>
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Tanggal Reservasi</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyewaan as $item)
                                <tr>
                                    <td> {{ $item->no_invoice }} <span class="badge bg-secondary">Selesai</span></td>
                                    <td>{{ date('D, d M Y H:i', strtotime($item->created_at)) }}</td>
                                    <td><b>{{ $item->user->name }}</b> ({{ $item->user->email }})</td>
                                    <td>@money($item->total) &nbsp; <span class="badge bg-secondary">{{ $item->order->count() }} Alat</span></td>
                                    <td>
                                        <a href="{{ route('penyewaan.detail',['id' => $item->id]) }}" class="btn btn-outline-primary position-relative">
                                            Detail
                                        </a>
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
@endsection
