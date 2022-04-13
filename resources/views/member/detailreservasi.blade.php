@extends('member.main')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex">
                <a href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i></a> &nbsp;
                <h5>Detail Reservasi</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alat</th>
                            <th>Pengambilan</th>
                            <th>Pengembalian</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex justify-content-between"></div>
                                    <span class="badge bg-warning">{{ $item->alat->category->nama_kategori }}</span>
                                    {{ $item->alat->nama_alat }}
                                    <span class="badge bg-secondary">{{ $item->durasi }} Jam</span>
                                </td>
                                <td>{{ date('d M Y', strtotime($item->start_date)) }} {{ date('H:i', strtotime($item->start_time)) }}</td>
                                <td>{{ date('d M Y', strtotime($item->end_date)) }} {{ date('H:i', strtotime($item->end_time)) }}</td>
                                <td style="text-align: right"><b>@money($item->harga)</b></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td style="text-align: right"><b>Total</b></td>
                            <td style="text-align: right"><b>@money($total)</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
