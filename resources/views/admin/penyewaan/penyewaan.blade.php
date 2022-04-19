@extends('admin.main')
@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body" style="overflow: auto">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Tanggal Pengambilan</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyewaan as $item)
                                <tr>
                                    <td> {{ $item->no_invoice }}
                                        @if ($item->status == 1)
                                            <span class="badge bg-warning">Perlu Ditinjau</span>
                                        @elseif ($item->status == 2)
                                            <span class="badge bg-info">Belum Bayar</span>
                                        @elseif ($item->status == 3)
                                            <span class="badge bg-success">Sudah Bayar</span>
                                        @endif
                                    </td>
                                    <td>{{ date('D, d M Y H:i', strtotime($item->order->first()->starts)) }}</td>
                                    <td><b>{{ $item->user->name }}</b> ({{ $item->user->email }})</td>
                                    <td>@money($item->total) &nbsp; <span class="badge bg-secondary">{{ $item->order->count() }} Alat</span></td>
                                    <td><a href="{{ route('penyewaan.detail',['id' => $item->id]) }}" class="btn btn-outline-primary">Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    @include('partials.kalender')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
