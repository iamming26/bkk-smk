@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3 custom-bg">
                    <img src="https://dummyimage.com/1200x80/000/fff" class="card-img-top">
                    <div class="card-body">
                      <h5 class="card-title">Pekerjaan yang dilamar:</h5>
                      <table class="table table-stripped" id="dataTable">
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
                                        <form action="" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $job->id }}">
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#detailModal{{ $loop->iteration }}">detail</button>
                                            <a href="{{ route('user.delete', ['id'=>$job->id]) }}" class="btn btn-sm btn-danger" data-confirm-delete="true">hapus</a>
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
                                        <p>{{ $job->start }} s.d. {{ $job->end }}</p>
                                        <h5 class="mt-2">Pelaksanaan Tes:</h5>
                                        <p>{{ $job->selection ?? '*menyusul' }}</p>
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

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
    new DataTable('#dataTable', {
        info: false,
        ordering: false,
        paging: false,
        searching: false,
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
});
</script>
@endsection