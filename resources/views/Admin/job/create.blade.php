@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="row p-3">
                <div class="col-md-12 mb-4">
                    <h3><a href="/admin/job">Lowongan</a> / Tambah</h3>
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