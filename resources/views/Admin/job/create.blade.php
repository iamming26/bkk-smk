@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="row p-3">
                <div class="col-md-6 col-sm-12">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-fill-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1"/>
                            <path d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12.31 12.31 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7m6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.552 4.552 0 0 1 .23-2.002m-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.507 4.507 0 0 1-1.3-1.905"/>
                        </svg>
                        Tambah Data Lowongan Pekerjaan
                    </h3>
                </div>
                <div class="col-md-6 col-sm-12 text-end">
                    <a href="{{ route('admin.dashboard') }}" class="b"><< Dashboard</a>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3" method="post" action="/admin/job" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <label for="instation_id" class="form-label">Instansi</label>
                        <select id="instation_id" name="instation_id" class="form-select @error('instation_id') is-invalid @enderror">
                            <option value="" selected> -- Pilih</option>
                            @foreach ($instations as $instation)
                            <option {{ old('instation_id') == $instation->id ? 'selected' : '' }} value="{{ $instation->id }}">{{ $instation->name }}</option>
                            @endforeach
                        </select>
                        @error('instation_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="position" class="form-label">Posisi</label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" id="position">
                        @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="start" class="form-label">Dibuka Pada:</label>
                        <input type="date" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" id="start">
                        @error('start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="end" class="form-label">Sampai Dengan:</label>
                        <input type="date" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" id="end">
                        @error('end')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="desc" class="form-label">Kualifikasi:</label>
                        <textarea class="form-control @error('desc') border-danger @enderror" name="desc" id="desc" cols="30" rows="10">{{ old('desc') }}</textarea>
                        @error('desc')
                            <span>
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="notes" class="form-label">Catatan:</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" cols="30" rows="10">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="selection" class="form-label">Pelaksanaan Tes:</label>
                        <input type="date" class="form-control @error('foto') is-invalid @enderror" name="selection" value="{{ old('selection') }}" id="selection">
                        @error('selection')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="photo" class="form-label">Foto Opsional:</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="{{ old('photo') }}" id="photo">
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $(document).ready(function() {
        $('#instation').select2();
    });
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
    // ClassicEditor is the name of the CKEditor class for the classic editor
    ClassicEditor
        .create(document.querySelector('#desc'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection