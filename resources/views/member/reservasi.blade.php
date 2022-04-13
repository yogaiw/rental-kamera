@extends('member.main')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Reservasi Anda</h5>
            </div>
            <div class="card-body">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alat</th>
                            <th>Pengambilan</th>
                            <th>Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservasi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex justify-content-between"></div>
                                    {{ $item->alat->nama_alat }}
                                    <span class="badge bg-secondary">{{ $item->durasi }} Jam</span>
                                </td>
                                <td>{{ date('d M Y', strtotime($item->start_date)) }} {{ date('H:i', strtotime($item->start_time)) }}</td>
                                <td>{{ date('d M Y', strtotime($item->end_date)) }} {{ date('H:i', strtotime($item->end_time)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-bosy">
                <table class="table">
                    <tbody>
                        @foreach ($sesi as $item)
                        <tr>
                            <td>@money($item->total)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
