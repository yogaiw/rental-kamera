@extends('member.main')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Reservasi Anda</h5>
            </div>
            <div class="card-body" style="overflow: auto">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>Tanggal Pengambilan</th>
                            <th>Total</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservasi as $item)
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
