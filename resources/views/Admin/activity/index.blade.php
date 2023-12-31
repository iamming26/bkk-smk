@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <h3>Aktifitas</h3>
        </div>

        <div class="card">
            <div class="row p-3">
                <div class="col-md-6 col-sm-12">
                    <h5>Data Aktifitas</h5>
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
                        {{-- @foreach ($jobs as $job)
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
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('components/datatable')
@endsection
