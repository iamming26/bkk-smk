@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            @include('components.alerts')
        </div>

        @foreach ($jobs as $job)
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
                            @if ($job->status)
                            <button type="button" class="btn btn-sm btn-warning">Sudah Melamar</button>
                            @else
                                @if (Auth::user()->type != 'admin')
                                <button type="submit" class="btn btn-sm btn-primary">Lamar</button>
                                @endif
                            @endif
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                            @endauth
                        </div>
                    @endif
                </div>
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
        @endforeach
    </div>
</div>
@endsection
