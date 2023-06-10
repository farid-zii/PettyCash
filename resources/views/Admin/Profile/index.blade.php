@extends('admin.layouts.main')

@section('isi')
    <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-success shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-uppercase ps-3">Profle</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    <div class="mx-3">
                        <a href="/pangkat-pdf" target="blank" class="btn bg-gradient-danger w-15 my-4 mb-2"><i class="bi bi-file-earmark-pdf-fill"></i>Cetak Pdf</a>
                        {{-- <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button> --}}
                        <a href="/export-data" blank class="btn bg-gradient-success w-15 my-4 mb-2"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Cetak Excel</a>
                        {{-- <a href="/admin/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
