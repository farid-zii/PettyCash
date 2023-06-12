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
                    <div class="alert alert-success alert-dismissible fade show" style="width: 50%;margin:0 auto;"
                        role="alert">
                        <strong>{{session('add')}}</strong>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    @endif

                    @if (session()->has('edit'))
                    <div class="alert alert-success text-light" role="alert">
                        <strong>
                            {{ session ('edit') }}
                        </strong>
                    </div>
                    @endif

                    <div class="mx-3">
                        <a href="/pangkat-pdf" target="blank" class="btn bg-gradient-danger w-15 my-4 mb-2"><i class="bi bi-file-earmark-pdf-fill"></i>Cetak Pdf</a>
                        {{-- <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button> --}}
                        <a href="/export-data" blank class="btn bg-gradient-success w-15 my-4 mb-2"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Cetak Excel</a>
                        {{-- <a href="/admin/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                    </div>
                    <div class="table-responsive p-1">
                        <table class="table align-items-center mb-0 table-bordered border-dark">
                            <thead>
                                <tr class="bg-dark">
                                    <th
                                        class=" text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Kode</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Nama/Departemen</th>
                                    <th style="width: 50px"
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Keterangan</th>
                                    <th style=""
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7 ">
                                        Rekening</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7 ">
                                        Kredit</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7 ">
                                        Debit</th>
                                    <th colspan="2"
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Approve</th>
                                    <th
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr>
                                    <td class="">202305001</td>
                                    <td class="">Pandaman</td>
                                    <td class="" style="width: 50px"></td>
                                    <td class="">
                                        <p class="text-xs font-weight-bold mb-0">31231231231314r</p>
                                        <p class="text-xs text-secondary mb-0">BCA</p>
                                    </td>
                                    <td class="">40000</td>
                                    <td class="">40000</td>
                                    <td class="text-center">✔</td>
                                    <td class="text-center">❌</td>
                                    <td class="text-center">
                                        <button>View</button>
                                        <button>Edit</button>
                                        <button>Delete</button>
                                    </td>
                                </tr>
                                @foreach ($pengajuan as $data )
                                <tr>
                                    <td class=""> {{$data->id}}</td>
                                    <td class="">
                                        <p class="text-xl font-weight-bold mb-0">{{$data->pegawai->nama}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->pegawai->departemen->nama}}</p>
                                    </td>
                                    <td class="" style="width: 50px">{{$data->keterangan}}</td>
                                    <td class="">
                                        <p class="text-xs font-weight-bold mb-0">{{$data->norek}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->bank}}</p>
                                    </td>

                                    @if ($data->type=='penambahan')
                                    <td class="text-right">-</td>
                                    <td class="text-right">@rp($data->nominal)</td>
                                    @elseif ($data->type=='pengajuan')
                                    <td class="text-right">@rp($data->nominal)</td>
                                    <td class="text-right">-</td>
                                    @endif
                                    {{--  --}}
                                    <td class="text-center">{{$data->approveF}}</td>
                                    {{--  --}}
                                    <td class="text-center">{{$data->approveD}}</td>
                                    {{--  --}}
                                    <td class="bg-info text-center">
                                        <div class="d-flex">
                                            <button class="btn btn-warning font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-warning font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}"><i class="bi bi-pencil-square"></i></button>
                                            <form action="/admin/pangkat/{{$data->id}}" method="post" class="">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger font-weight-bold m-auto" type="submit"
                                                    onclick="return confirm('Yakin akan menghapus data ?')"><i class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-center">Total Dana</td>
                                    <td colspan="">Rp.@rp(50000)</td>
                                    <td colspan="">Rp.@rp(20000)</td>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CREATE -->
@include('admin.pengajuan.create')

{{-- EDIT --}}
{{-- @foreach ($pangkat as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Pangkat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/pangkat/{{$data->id}}">
                @method('PUT')
                <div class="modal-body">
                    @csrf
                    <label class="text-xl text-dark font-weight-bolder">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="" name="nama"
                            value="{{$data->nama}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Kode</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder=""
                            name="kode" value="{{$data->kode}}">
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
@endforeach --}}

@endsection
