@extends('member.main')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex">
                <a href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i></a> &nbsp;
                <h5>Detail Reservasi</h5>
            </div>
            <div class="card-body" style="overflow: auto">
                <b>Tanggal Pengambilan :</b> {{ date('d M Y H:i', strtotime($detail->first()->starts)) }}
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alat</th>
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
                                    {{ $item->alat->nama_alat }}
                                    <span class="badge bg-warning">{{ $item->alat->category->nama_kategori }}</span>
                                    <span class="badge bg-secondary">{{ $item->durasi }} Jam</span>
                                </td>
                                <td>{{ date('d M Y H:i', strtotime($item->ends)) }}</td>
                                <td style="text-align: right"><b>@money($item->harga)</b></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                            <td style="text-align: right"><b>Total</b></td>
                            <td style="text-align: right"><b>@money($total)</b></td>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-primary">
                    Cara pembayaran akan dijelaskan disini.
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <input class="form-control w-50 mx-2" type="file" name="bukti">
                    <button class="btn btn-success">Upload Bukti Bayar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
