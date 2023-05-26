@extends('admin.layouts.main')

@section('isi')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-success shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-uppercase ps-3">Data {{$title}}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    @include('Admin.notif')

                    <div class="mx-3">
                        <a href="/saldo-pdf" target="blank" class="btn bg-gradient-danger w-15 my-4 mb-2"><i
                                class="bi bi-file-earmark-pdf-fill"></i>Cetak Pdf</a>
                        {{-- <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button> --}}
                        <a href="/saldo-data" blank class="btn bg-gradient-success w-16 my-4 mb-2"><i
                                class="bi bi-file-earmark-spreadsheet-fill"></i> Cetak Excel</a>
                        {{-- <a href="/admin/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                    </div>
                    <div class="table-responsive px-3">
                        <table class="table table-bordered border-dark" style="">
                            <thead>
                                <tr class="bg-dark" style="font-color:white;">
                                    <th class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        No</th>
                                    <th style="" class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        {{$title}}</th>

                                    <th class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        keterangan</th>
                                    <th class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        nominal</th>
                                    <th class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        hasil</th>
                                    <th style="width: 10%"
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @if($datas->count())
                                @foreach ($datas as $data )
                                <tr class="@if ($data->status == 'Tambah') bg-gradient-success  @else bg-danger @endif">
                                    <td class="">{{$loop->iteration}}</td>
                                    <td class="" style="">
                                        <p class="align-middle">@rp($data->saldo)</p>
                                    </td>
                                    <td class="" style="">
                                        <p class="align-middle">Saldo Awal</p>
                                    </td>
                                    <td class="">
                                        <p class="align-middle"> @rp($data->nominal)</p>
                                    </td>
                                    <td class="">
                                        <p class="align-middle"> @rp($data->hasil)</p>
                                    </td>
                                    <td class="bg-info">
                                        <div class="d-flex">
                                            <button class="btn btn-warning font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#data-{{$data->id}}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#delete-{{$data->id}}"><i
                                                    class="bi bi-trash3-fill"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">DATA TIDAK ADA</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            {{$datas->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CREATE -->
<div class="modal fade" dty id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Entry Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="/admin/saldo">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder" required>saldo</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="number" class="form-control" name="saldo" value="{{$datas[0]->hasil}}"
                            aria-describedby="basic-addon1">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder ">nominal</label>
                    <div class="mb-2">
                        <input type="number" class="form-control " placeholder="" id='nominal' required name="nominal"
                            value="{{old('nominal')}}">
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Tambah</label>
                        <input type="radio" value="Tambah" name="status">
                        <label class="text-xl text-dark font-weight-bolder">Kurang</label>
                        <input type="radio" value="Kurang" name="status">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Save</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-dark float-sm-end col-md-2 mt-4 me-3">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT --}}
@foreach ($datas as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/saldo/{{$data->id}}">
                @method('PUT')
                <div class="modal-body">
                    @csrf
                    <label class="text-xl text-dark font-weight-bolder">Saldo</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="saldo" value="{{$data->saldo}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">nominal</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" required placeholder="" name="nominal"
                            value="{{$data->nominal}}">
                    </div>

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-warning float-sm-start col-md-2 mt-4">Edit</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
{{-- Delete --}}
@foreach ($datas as $data)
<div class="modal fade" dty id="delete-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h1 class="modal-title fs-5 fw-bolder text-light" id="staticBackdropLabel">Delete Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/saldo/{{$data->id}}">
                @method('Delete')
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="text-xl text-dark font-weight-bolder">saldo</label>
                        <input class="form-control col-mb-3" disabled value="{{$data->saldo}}">
                    </div>
                    <div class="form-group">
                        <label class="text-xl text-dark font-weight-bolder">nominal</label>
                        <input class="form-control col-mb-3" disabled value="{{$data->nominal}}">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-danger float-sm-start col-md-2 mt-4 me-3">delete</button>
                    <button type="button" class="btn btn-info float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


@endsection
