@extends('admin.main')
@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body" style="overflow: auto">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyewaan as $item)
                                <tr>
                                    <td>{{ date('D, d M Y H:i', strtotime($item->created_at)) }}</td>
                                    <td><b>{{ $item->user->name }}</b> ({{ $item->user->email }})</td>
                                    <td>@money($item->total) &nbsp; <span class="badge bg-secondary">{{ $item->order->count() }} Alat</span></td>
                                    <td><a href="{{ route('penyewaan.detail',['id' => $item->id]) }}" class="btn btn-outline-primary">Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
