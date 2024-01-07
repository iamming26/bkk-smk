@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 mb-4">
            <div class="card border-0">
                <form action="#" method="get" class="row g-3">
                    <div class="col-md-6">
                        <select class="form-select" id="position" name="position" onchange="this.form.submit()">
                            <option {{ $_GET['position'] ? '' : 'selected' }} value="" selected>-- Posisi</option>
                            <option {{ $_GET['position'] == 'operator' ? 'selected' : '' }} value="operator">Operator</option>
                            <option {{ $_GET['position'] == 'QC' ? 'selected' : '' }} value="QC">QC</option>
                            <option {{ $_GET['position'] == 'maintenance' ? 'selected' : '' }} value="maintenance">Maintenance</option>
                            <option {{ $_GET['position'] == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                            <option {{ $_GET['position'] == 'staff' ? 'selected' : '' }} value="staff">Staff</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" id="study" name="study" onchange="this.form.submit()">
                            <option value="" {{  $_GET['study'] ? '' : 'selected' }}>-- Pendidikan</option>
                            <option {{ $_GET['study'] == 'SMA' ? 'selected' : '' }} value="SMA">SMA</option>
                            <option {{ $_GET['study'] == 'SMK' ? 'selected' : '' }} value="SMK">SMK</option>
                            <option {{ $_GET['study'] == 'D3' ? 'selected' : '' }} value="D3">D3</option>
                            <option {{ $_GET['study'] == 'S1' ? 'selected' : '' }} value="S1">S1</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        @forelse ($jobs as $job)
        <div class="col-md-4 mb-4">
            <div class="card" style="">
                <img src="https://dummyimage.com/600x400/000/fff" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $job->instation }}</h5>
                    <p class="card-text">{{ $job->position }}</p>
                </div>
                <div class="card-body">
                    @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                            <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#detailModal{{ $loop->iteration }}">Detail</a>
                            @auth
                            <form action="{{ route('apply') }}" class="d-inline" method="post">
                            @csrf
                            <input type="hidden" name="instation_id" value="{{ $job->id }}">
                            <input type="hidden" name="instation_name" value="{{ $job->instation }}">
                            <input type="hidden" name="position" value="{{ $job->position }}">
                            @if ($job->status)
                            <button type="button" class="btn btn-sm btn-warning">Sudah Melamar</button>
                            @else
                                @if (Auth::user()->type != 'admin')
                                    @if ($job->is_open)
                                    <button type="submit" class="btn btn-sm btn-primary">Lamar</button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-danger">Ditutup</button>
                                    @endif
                                @endif
                            @endif
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                            @endauth
                        </div>
                    @endif
                </div>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $loop->iteration }}
                    <span class="visually-hidden">{{ $loop->iteration }}</span>
                  </span>
            </div>
        </div>
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
                    <h5 class="mt-2">Penempatan:</h5>
                    <p>{{ $job->address }}</p>
                    <h5 class="mt-2">Periode Pendaftaran:</h5>
                    <p>{{ $job->start }} s.d. {{ $job->end }}</p>
                    <h5 class="mt-2">Pelaksanaan Tes:</h5>
                    <p>{{ $job->selection ?? '*menyusul' }}</p>
                    <h5 class="mt-2">Catatan:</h5>
                    <p>{{ $job->notes ?? '-' }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    @auth
                    <form action="{{ route('apply') }}" method="post">
                    @csrf
                    <input type="hidden" name="instation_id" value="{{ $job->id }}">
                    @if (Auth::user()->type == 'user')
                    <button type="submit" class="btn btn-sm btn-primary">Lamar</button>
                    @endif
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                    @endauth
                </div>
            </div>
            </div>
        </div>
        @empty
        <div class="card">
            <div class="card-body text-center">
                <small class="fw-italic text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
                        <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                    Data Tidak Ditemukan
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
                        <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </small>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
