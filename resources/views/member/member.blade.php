@extends('member.main')
@section('container')
<div class="row mb-4">
    <div class="col col-sm-12">
        <div class="d-flex w-100 justify-content-start" style="overflow: auto">
            <a class="btn btn-primary mx-1" href="{{ route('member.index') }}">Semua</a>
            @foreach ($kategori as $cat)
                <a class="btn btn-primary mx-1" href="?kategori={{ $cat->id }}">{{ $cat->nama_kategori }}</a>
            @endforeach
        </div>
    </div>
</div>
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
                            <b><a href="{{ route('home.detail',['id' => $item->id]) }}" class="mb-1 link-dark">{{ $item->nama_alat }}</a></b>
                            <small><span class="badge bg-warning">{{ $item->category->nama_kategori }}</span></small>
                          </div>
                          <p class="mb-1">Deskripsi</p>
                          <form action="{{ route('cart.store',['id' => $item->id]) }}" method="POST">
                            @csrf
                            <div class="d-grid gap-2 d-md-block">
                                <button type="submit" class="btn btn-sm btn-primary" name="btn" value="24"><i class="fas fa-shopping-cart"></i> @money($item->harga24) <b>24jam</b></button>
                                <button type="submit" class="btn btn-sm btn-primary" name="btn" value="12"><i class="fas fa-shopping-cart"></i> @money($item->harga12) <b>12jam</b></button>
                                <button type="submit" class="btn btn-sm btn-primary" name="btn" value="6"><i class="fas fa-shopping-cart"></i> @money($item->harga6) <b>6jam</b></button>
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
        <div class="card" id="keranjang">
            <div class="card-header" id="keranjang">
                <b>Keranjang</b> <span class="badge bg-secondary">{{ Auth::user()->cart->count() }}</span>
            </div>
            <div class="card-body">
                <div>
                    <div class="list-group">
                        @foreach ($carts as $item)
                        <div class="list-group-item list-group-item-action" aria-current="true">
                          <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $item->alat->nama_alat }}</h6>
                            <b>@money($item->harga)</b>
                          </div>
                          <div class="d-flex w-100 justify-content-between">
                            <p class="mb-1">{{ $item->durasi }} Jam </p>
                            <form action="{{ route('cart.destroy',['id' => $item->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button style="background: none" type="submit"><i class="fas fa-trash" style="color: gray"></i></a>
                            </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex w-100 justify-content-between mb-2">
                    <b>Total</b>
                    <b>@money($total)</b>
                </div>
                <small>Tanggal Ambil</small>
                <div class="d-flex w-100 justify-content-center mb-4">
                    <input type="date" class="forn-control">
                    <input type="time" class="form-control">
                </div>
                <a href="" style="width:100%" class="btn btn-success">Checkout</a>
            </div>
        </div>
    </div>
</div>
@endsection
