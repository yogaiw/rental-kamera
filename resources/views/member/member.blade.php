@extends('member.main')
@section('container')
<div class="row">
    <div class="col col-md-8 col-sm-12">
        <div class="card h-100">
            <div class="card-header"><b>Alat</b></div>

            <div class="card-body">
                <div style="height: 500px; overflow:scroll">
                    <div class="list-group">
                        @foreach ($alat as $item)
                        <div class="list-group-item list-group-item-action" aria-current="true">
                          <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $item->nama_alat }}</h6>
                            <small><span class="badge bg-warning">{{ $item->category->nama_kategori }}</span></small>
                          </div>
                          <p class="mb-1">Deskripsi</p>
                          <small class="mb-1">klik untuk menambahkan ke keranjang</small><br>
                          <form action="{{ route('cart.store',['id' => $item->id]) }}" method="POST">
                            @csrf
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit" class="btn btn-sm btn-primary" name="btn" value="24">@money($item->harga24) <b>24jam</b></button>
                                <button type="submit" class="btn btn-sm btn-primary" name="btn" value="12">@money($item->harga12) <b>12jam</b></button>
                                <button type="submit" class="btn btn-sm btn-primary" name="btn" value="6">@money($item->harga6) <b>6jam</b></button>
                            </div>
                          </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-4 col-sm-12">
        <div class="card h-100">
            <div class="card-header" id="keranjang">
                <b>Keranjang</b>
            </div>
            <div class="card-body">
                <div>
                    <div class="list-group">
                        @foreach ($carts as $item)
                        <div class="list-group-item list-group-item-action" aria-current="true">
                          <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $item->alat->nama_alat }}</h6>
                            <b> {{ $item->durasi }} Jam </b>
                          </div>
                          <p class="mb-1">@money($item->harga)</p>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex w-100 justify-content-between">
                    <b>Total</b>
                    <b></b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
