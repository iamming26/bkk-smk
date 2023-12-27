@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            {{-- @include('components.alerts') --}}
        </div>

        <div class="col-md-12">
            <div class="card custom-bg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="container d-flex justify-content-center">
                                <div class="card-in-container item-center bg-white" style="width: 18rem;">
                                    <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" class="card-img-top" alt="...">
                                    <a data-bs-toggle="modal" data-bs-target="#modalImage">
                                        <h1>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                                <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                                                <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                            </svg>
                                        </h1>
                                    </a>

                                    {{-- <img src="{{ asset('ucon.jpeg') }}" class="card-img-top" alt="..."> --}}
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $user->name }}</h5>
                                      <p class="card-text">{{ $user->email }}</p>
                                      <a href="#" class="btn btn-primary">{{ $user->type }}</a>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="container">
                                <div class="card card-in-container">
                                    <div class="card-body">
                                        <form method="post" action="{{ (Auth::user()->id == 'admin') ? route('admin.profile.update', ['id'=>Auth::user()->id]) : route('user.profile.update', ['id'=>Auth::user()->id]) }}">
                                            @csrf
                                            @method('put')
                                            <div class="row mb-3">
                                              <label for="email" class="col-sm-2 col-form-label">Email</label>
                                              <div class="col-sm-10">
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Isi email baru jika akan dirubah...">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </div>
                                                @enderror
                                              </div>
                                            </div>
                                            <div class="row mb-3">
                                              <label for="password_new" class="col-sm-2 col-form-label">Password Baru</label>
                                              <div class="col-sm-10">
                                                <input type="password" value="{{ old('password_new') }}" name="password_new" class="form-control @error('password_new') is-invalid @enderror" id="password_new" placeholder="Isi password baru jika akan dirubah...">
                                                @error('password_new')
                                                <div class="invalid-feedback">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </div>
                                                @enderror
                                              </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="confirmation_password_new" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                                                <div class="col-sm-10">
                                                  <input type="password" value="{{ old('confirmation_password_new') }}" name="confirmation_password_new" class="form-control @error('confirmation_password_new') is-invalid @enderror" id="confirmation_password_new" placeholder="Isi password baru jika akan dirubah...">
                                                  @error('confirmation_password_new')
                                                  <div class="invalid-feedback">
                                                      <small class="text-danger">{{ $message }}</small>
                                                  </div>
                                                  @enderror
                                                </div>
                                              </div>
                                            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConfirmation">Update</a>

                                            <div class="modal fade" id="modalConfirmation" tabindex="-1" aria-labelledby="modalConfirmationLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="modalConfirmationLabel">Verifikasi Password</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body custom-bg">
                                                        <input type="password" value="{{ old('password_old') }}" name="password_old" class="form-control @error('password_old') is-invalid @enderror" id="password_old" placeholder="Isikan dengan password saat ini.." required>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="submit" class="btn btn-primary">Lanjutkan</button>
                                                    </div>
                                                  </div>
                                                </div>
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


<div class="modal fade" id="modalImage" tabindex="-1" aria-labelledby="modalImageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalImageLabel">Upload Foto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
            <div class="modal-body custom-bg">
                <input type="file" value="{{ old('file') }}" name="file" class="form-control @error('file') is-invalid @enderror" id="file" placeholder="Isikan dengan password saat ini..">
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .card-img-top {
        width: 60%;
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .card-in-container {
        padding: 1.5em 0.5em 0.5em;
        border-radius: 2em;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .item-center{
        text-align: center;
    }
    
    .card-title {
    font-weight: bold;
    font-size: 1.5em;
    }
    .btn-primary {
        border-radius: 2em;
        padding: 0.5em 1.5em;
    }

    .custom-bg{
        background-color: #00DBDE;
        background-image: linear-gradient(90deg, #00DBDE 0%, #FC00FF 100%);
    }

</style>
@endsection