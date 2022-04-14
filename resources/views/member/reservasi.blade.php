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
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservasi as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                <td>@money($item->total)</td>
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
