@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('components.alerts')
                <div class="card mb-3">
                    <img src="https://dummyimage.com/1200x80/000/fff" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Pekerjaan yang dilamar:</h5>
                      <table class="table table-stripped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Instansi</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Tanggal Melamar</th>
                            <th scope="col">Pelaksanaan Tes</th>
                            <th scope="col">Tindakan</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($applies as $job)                                
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $job->instation }}</td>
                                <td>{{ $job->position }}</td>
                                <td>{{ $job->apply_date }}</td>
                                <td class="text-primary fw-bold">{{ $job->selection ?? '*menyusul' }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{ route('user.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $job->id }}">
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#detailModal{{ $loop->iteration }}">detail</button>
                                            <button type="submit" class="btn btn-sm btn-danger">hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="detailModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="detailModal{{ $loop->iteration }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="detailModal{{ $loop->iteration }}Label">{{ $job->instation }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="mb-2">Persyaratan:</h5>
                                        {!! $job->desc !!}
                                        <h5 class="mt-2">Periode Pendaftaran:</h5>
                                        <p>{{ \Carbon\Carbon::parse($job->start)->format('d-m-Y') }} s.d. {{ \Carbon\Carbon::parse($job->end)->format('d-m-Y') }}</p>
                                        <h5 class="mt-2">Pelaksanaan Tes:</h5>
                                        <p>{{ \Carbon\Carbon::parse($job->selection)->format('d-m-Y') ?? '*menyusul' }}</p>
                                        <h5 class="mt-2">Catatan:</h5>
                                        <p>{{ $job->notes ?? '-' }}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection