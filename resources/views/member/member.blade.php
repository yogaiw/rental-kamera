@extends('member.main')
@section('container')
<div class="row">
    <div class="col col-md-8">
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
                          <p class="mb-1">Some placeholder content in a paragraph.</p>
                          <small>And some small print.</small>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-4">
        <div class="card h-100">
            <div class="card-header" id="keranjang">
                <b>Keranjang</b>
            </div>
            <div class="card-body"></div>
        </div>
    </div>
</div>
@endsection
