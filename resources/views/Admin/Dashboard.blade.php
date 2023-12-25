@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            @include('components.alerts')
        </div>

        <div class="card">
            <div class="row p-3">
                <div class="col-md-6 col-sm-12">
                    <h5>Daftar Lowongan Pekerjaan</h5>
                </div>
                <div class="col-md-6 col-sm-12 text-end">
                    <a href="/admin/job/create" class="btn btn-sm btn-primary text-end">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Instansi</th>
                            <th>Posisi</th>
                            <th>Pendaftaran</th>
                            <th>Seleksi</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $job->instation }}</td>
                                <td>{{ $job->position }}</td>
                                <td>{{ $job->start }} s.d {{ $job->end }}</td>
                                <td class="text-center">{{ $job->selection }}</td>
                                <td class="text-center">{{ $job->total }}</td>
                                <td class="text-center">
                                    <a href="/admin/job/show/{{ $job->id }}" class="btn btn-sm btn-success">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
    new DataTable('#example', {
    responsive: true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    }
});
</script>
@endsection