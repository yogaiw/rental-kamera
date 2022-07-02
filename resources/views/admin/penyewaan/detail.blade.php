@extends('admin.main')
@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('penyewaan.index') }}"><i class="fas fa-arrow-left"></i></a> Detail
                        @if ($status == 1)
                            <span class="badge bg-warning">Perlu Ditinjau</span>
                        @elseif ($status == 2)
                            <span class="badge bg-info">Belum Bayar</span>
                        @elseif ($status == 3)
                            <span class="badge bg-success">Sudah Bayar</span>
                        @elseif ($status == 4)
                            <span class="badge bg-secondary">Selesai</span>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="overflow: auto">
                    <table class="table table-success w-100">
                        <tbody>
                            <tr>
                                <th>No. Invoice</th>
                                <td>{{ $detail->first()->payment->no_invoice }}</td>
                            </tr>
                            <tr>
                                <th>Penyewa</th>
                                <td><b>{{ $detail->first()->user->name }}</b> ({{ $detail->first()->user->email }})</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>{{ $detail->first()->user->telepon }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengambilan</th>
                                <td>
                                    {{ date('d M Y H:i', strtotime($detail->first()->starts)) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

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
                        <form action="{{ route('acc',['paymentId' => $detail->first()->payment->id]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            @foreach($detail as $item)
                            <tr class="{{ ($item->status == 3) ? 'table-danger' : '' }}">
                                <td>
                                    {{ $loop->iteration }}
                                    @if ($status == 1)
                                        <input type="checkbox" name="order[]" class="form-check-input" value="{{ $item->id }}">
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between"></div>
                                    <a class="link-dark" href="{{ route('home.detail',['id' => $item->alat->id]) }}" class="link">{{ $item->alat->nama_alat }}</a>
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
                                <td>
                                    @if ($status == 1)
                                        <button type="submit" class="btn btn-success">Acc</a>
                                    @endif
                                </td>
                                <td></td>
                                <td style="text-align: right"><b>Total</b></td>
                                <td style="text-align: right"><b>@money($total)</b></td>
                            </tr>
                        </form>
                        </tbody>
                    </table>
                    @if ($status == 1 || $status == 2)
                        <form action="{{ route('admin.penyewaan.cancel',['id' => $detail->first()->payment->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="javascript: return confirm('Anda yakin akan membatalkan reservasi?');" class="btn btn-danger mb-3">Cancel Reservasi</button>
                        </form>
                    @endif
                    @if ($status == 3)
                    <form action="{{ route('selesai',['id' => $detail->first()->payment->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success mb-4" onclick="javascript: return confirm('Pastikan alat sudah dikembalikan semua, jika yakin lanjutkan');">Sudah dikembalikan</button>
                    </form>
                    @endif
                    @if ($status != 1)
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Bukti Pembayaran
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if ($detail->first()->payment->bukti == NULL)
                                    Belum melakukan upload bukti pembayaran
                                @else
                                    <form action="{{ route('accbayar',['id' => $detail->first()->payment->id]) }}" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-success mb-4" {{ ($status == 3 || $status == 4) ? 'disabled' : '' }}>Acc Pembayaran</button>
                                    </form>
                                    <img src="{{ url('') }}/images/evidence/{{ $detail->first()->payment->bukti }}" alt="" width="500px">
                                @endif
                            </div>
                          </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-block">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
