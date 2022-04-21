@extends('member.main')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <a href="{{ route('order.show') }}"><i class="fas fa-arrow-left"></i></a> &nbsp;
                <h5>Detail Reservasi</h5>
                @if ($paymentStatus == 1)
                    <span class="badge bg-warning">Sedang Ditinjau</span>
                @elseif ($paymentStatus == 2)
                    <span class="badge bg-info">Belum Bayar</span>
                @elseif ($paymentStatus == 3)
                    <span class="badge bg-success">Sudah Bayar</span>
                @endif
            </div>
            <div class="card-body" style="overflow: auto">
                @if ($paymentStatus == 3)
                    <div class="alert alert-success">Silakan melakukan pengambilan alat pada tanggal yang tertera</div>
                @endif
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
                            <tr class="{{ ($item->status == 3) ? 'table-danger' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex justify-content-between"></div>
                                    {{ $item->alat->nama_alat }}
                                    <span class="badge bg-warning">{{ $item->alat->category->nama_kategori }}</span>
                                    <span class="badge bg-secondary">{{ $item->durasi }} Jam</span>
                                    @if ($item->status === 3)
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif ($item->status === 2)
                                        <span class="badge bg-success">ACC</span>
                                    @endif
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
                @if ($paymentStatus == 2)
                    <div class="alert {{ ($detail->first()->payment->bukti == NULL) ? 'alert-primary' : 'alert-success'}}">
                        @if ($detail->first()->payment->bukti == NULL)
                            Reservasi anda telah disetujui, silakan bayar sesuai dengan total yang tertera lalu upload bukti bayar dengan menekan tombol dibawah
                        @else
                            Bukti pembayaran telah di upload, silakan tunggu konfirmasi dari Admin
                        @endif
                        <form action="">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bayarModal">Bukti Pembayaran</a>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Bayar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('bayar',['id' => $paymentId]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="file" name="bukti" class="form-control mb-2" required>
                <button type="submit" class="btn btn-success">Upload</button>
            </form>
            <h5 class="mt-2">Bukti Bayar</h5>
            <img src="{{ url('') }}/images/evidence/{{ $bukti }}" alt="" width="500px">
        </div>
      </div>
    </div>
  </div>
@endsection
