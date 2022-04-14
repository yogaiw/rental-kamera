@extends('admin.main')
@section('content')
<div class="row">
    <div class="col-md-12 mx-4 mt-4">
        <div class="card">
            <div class="card-body">
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
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>@money($item->total) &nbsp; <span class="badge bg-secondary">{{ $item->order->count() }} Alat</span></td>
                                <td><a href="" class="btn btn-outline-primary">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
