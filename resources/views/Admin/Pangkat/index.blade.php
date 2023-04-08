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
                    {{--  --}}
                    @if (session()->has('add'))
                    <div class="alert alert-success alert-dismissible fade show timeout"
                        style="width: 30%;margin-left:70%;" role="alert">
                        <strong>{{session('add')}}</strong>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="position-fixed bottom-1 end-1 z-index-2">
        <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header border-0">
            <i class="material-icons text-success me-2">
        check
      </i>
                    @endif

                    @if (session()->has('edit'))
                    <div class="alert alert-warning alert-dismissible fade show timeout"
                        style="width: 30%;margin-left:70%;" role="alert">
                        <strong>{{session('edit')}}</strong>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                    @endif

                    @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show timeout"
                        style="width: 30%;margin-left:70%;" role="alert">
                        <strong>{{session('delete')}}</strong>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                    @endif

                    @if (session()->has('failed'))
                    <div class="alert alert-danger">
                        <strong>Failed!!</strong>
                        <strong>{{session('failed')}}</strong>
                    </div>
                    @endif

                    @if (count($errors)>0)
                    <div class="alert alert-danger">
                        <strong>Failed</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mx-3">
                        <a href="/pangkat-pdf" target="blank" class="btn bg-gradient-danger w-15 my-4 mb-2"><i
                                class="bi bi-file-earmark-pdf-fill"></i>Cetak Pdf</a>
                        {{-- <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button> --}}
                        <a href="/pangkat-data" blank class="btn bg-gradient-success w-16 my-4 mb-2"><i
                                class="bi bi-file-earmark-spreadsheet-fill"></i> Cetak Excel</a>
                        {{-- <a href="/admin/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                    </div>
                    <div class="table-responsive px-3">
                        <table class="table table-bordered border-dark" style="">
                            <thead>
                                <tr class="bg-dark" style="font-color:white;">
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        No</th>
                                    <th style=""
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        NAMA PANGKAT</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        KODE</th>
                                    <th style="width: 10%"
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @if($pangkat->count())
                                @foreach ($pangkat as $data )
                                <tr>
                                    <td class="">{{$loop->iteration}}</td>
                                    <td class="" style="">
                                        <p class="align-middle">{{$data->nama}}</p>
                                    </td>
                                    <td class="">
                                        <p class="align-middle"> {{$data->kode}}</p>
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
                                    <td colspan="4" class="text-center">DATA TIDAK ADA</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                                {{$pangkat->links('vendor.pagination.bootstrap-5')}}
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

            <form method="post" action="/admin/pangkat">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder" required>Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="" name="nama" value="{{old('kode')}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder ">Kode</label>
                    <div class="mb-2">
                        <input type="text" class="form-control " placeholder="" id='kode' required name="kode" value="{{old('kode')}}">
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
@foreach ($pangkat as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/pangkat/{{$data->id}}">
                @method('PUT')
                <div class="modal-body">
                    @csrf
                    <label class="text-xl text-dark font-weight-bolder">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" required name="nama" value="{{$data->nama}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Kode</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" required placeholder="" name="kode" value="{{$data->kode}}">
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
@foreach ($pangkat as $data)
<div class="modal fade" dty id="delete-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h1 class="modal-title fs-5 fw-bolder text-light" id="staticBackdropLabel">Delete Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/pangkat/{{$data->id}}">
                @method('Delete')
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="text-xl text-dark font-weight-bolder">Nama</label>
                        <input class="form-control col-mb-3" disabled value="{{$data->nama}}">
                    </div>
                    <div class="form-group">
                        <label class="text-xl text-dark font-weight-bolder">Kode</label>
                        <input class="form-control col-mb-3" disabled value="{{$data->kode}}">
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
