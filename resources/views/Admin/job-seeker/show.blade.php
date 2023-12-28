@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin/job-seeker">Peserta</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="card custom-bg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="container d-flex justify-content-center">
                                        <div class="card-in-container item-center bg-white">
                                            <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" style="max-height: 200px;" class="card-img-top" alt="...">
                                            <div class="card-body">
                                              <h5 class="card-title text-center">{{ $user->name }}</h5>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="container">
                                        <div class="card card-in-container">
                                            <div class="card-body">
                                                <h5>Data diri:</h5>
                                                <form class="row g-3">
                                                    <div class="col-md-6">
                                                      <label for="name" class="form-label">Nama</label>
                                                      <input class="form-control {{ $user->name == null ? 'is-invalid' : 'is-valid' }}" value="{{ $user->name }}" id="name" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <label for="email" class="form-label">Email</label>
                                                      <input class="form-control {{ $user->email == null ? 'is-invalid' : 'is-valid' }}" value="{{ $user->email }}" id="email" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="birth" class="form-label">Tempat lahir</label>
                                                        <input class="form-control {{ $user->detail->birth == null ? 'is-invalid' : 'is-valid' }}" value="{{ $user->detail->birth }}" id="birth" readonly>
                                                        @if (!$user->detail->birth)
                                                        <small class="text-danger">*data belum lengkap</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="date" class="form-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control {{ $user->detail->date == null ? 'is-invalid' : 'is-valid' }}" value="{{ $user->detail->date }}" id="date" readonly>
                                                        @if (!$user->detail->date)
                                                        <small class="text-danger">*data belum lengkap</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="phone" class="form-label">No HP</label>
                                                        <input class="form-control {{ $user->detail->phone == null ? 'is-invalid' : 'is-valid' }}" value="{{ $user->detail->phone }}" id="phone" readonly>
                                                        @if (!$user->detail->phone)
                                                        <small class="text-danger">*data belum lengkap</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="education" class="form-label">Pendidikan</label>
                                                        <input class="form-control {{ $user->detail->education == null ? 'is-invalid' : 'is-valid' }}" value="{{ $user->detail->education }}" id="education" readonly>
                                                        @if (!$user->detail->education)
                                                        <small class="text-danger">*data belum lengkap</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="school" class="form-label">Asal Sekolah</label>
                                                        <input class="form-control {{ $user->detail->school == null ? 'is-invalid' : 'is-valid' }}" value="{{ $user->detail->school }}" id="school" readonly>
                                                        @if (!$user->detail->school)
                                                        <small class="text-danger">*data belum lengkap</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="certificate" class="form-label">Ijazah</label>
                                                        <input class="form-control {{ $user->detail->certificate == null ? 'is-invalid' : 'is-valid' }}" value="{{ $user->detail->certificate }}" id="certificate" readonly>
                                                        @if (!$user->detail->certificate)
                                                        <small class="text-danger">*data belum lengkap</small>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
