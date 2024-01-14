@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <h3><a href="/admin/job">Lowongan</a> / Detail</h3>
        </div>

        <div class="card">
            <div class="row p-3">
                <div class="col-md-6 col-sm-12">
                    <h3>{{ $job->instation->name }}</h3>
                    <p>{{ $job->position }}</p>
                </div>
                <div class="col-md-6 col-sm-12 text-end">
                    <p>Batas melamar : <strong>{{ Carbon\Carbon::createFromDate($job->end)->isoFormat('D MMMM Y') }}</strong></p>
                </div>
            </div>
            <div class="card-body">
                <p>Kualifikasi:</p>
                {!! $job->desc !!}
                <p>Pelamar ({{ $applies->count() }}) :</p>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">-</th>
                        <th scope="col">-</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($applies as $apply)
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $apply->name }}</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
