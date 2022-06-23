@extends('member.main')
@section('container')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="card-title">Reservasi</h5>
        </div>
        <div class="card-body" style="overflow: auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal Pengambilan</th>
                        <th>Total</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasi as $item)
                        <tr>
                            <td>{{ date('D, d M Y H:i', strtotime($item->order->first()->starts)) }}</td>
                            <td>@money($item->total) &nbsp; <span class="badge bg-secondary">{{ $item->order->count() }} Alat</span>
                                @if ($item->status == 1)
                                    <span class="badge bg-warning">Sedang Ditinjau</span>
                                @elseif ($item->status == 2)
                                    <span class="badge bg-info">Belum Bayar</span>
                                @elseif ($item->status == 3)
                                    <span class="badge bg-success">Sudah Bayar</span>
                                @endif
                            </td>
                            <td><a class="btn btn-primary" href="{{ route('order.detail',['id' => $item->id]) }}">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td class="text-center" colspan="3">
                            <p>Anda belum melakukan reservasi apapun.</p>
                            <a href="{{ route('member.index') }}" class="btn btn-success">Mulai Reservasi Sekarang</a>
                        </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header"><h5 class="card-title">Riwayat</h5></div>
        <div class="card-body">
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>Tanggal Pengambilan</th>
                        <th>Total</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $r)
                        <tr>
                            <td>{{ date('D, d M Y H:i', strtotime($r->order->first()->starts)) }}</td>
                            <td>@money($r->total) &nbsp; <span class="badge bg-secondary">{{ $r->order->count() }} Alat</span>
                                <span class="badge bg-secondary">Selesai</span>
                            </td>
                            <td><a class="btn btn-primary" href="{{ route('order.detail',['id' => $r->id]) }}">Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
