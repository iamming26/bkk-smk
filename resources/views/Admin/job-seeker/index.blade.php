@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin/job-seeker">Peserta</a></li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="row p-3">
                <div class="col-md-6 col-sm-12">
                    <h5>Data Peserta</h5>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pendidikan</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobseekers as $user)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->detail->education ?? '-' }}</td>
                                <td>{{ $user->detail->phone ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="/admin/job-seeker/{{ $user->id }}" class="btn btn-sm btn-success">Detail</a>
                                    <a  href="/admin/job-seeker/{{ $user->id }}/delete" class="btn btn-sm btn-danger" data-confirm-delete="true">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('components/datatable')
@endsection
