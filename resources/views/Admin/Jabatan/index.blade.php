@extends('admin.layouts.main')

@section('isi')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-uppercase ps-3">Data {{$title}}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    {{--  --}}
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" style="width: 50%;margin:0 auto;"
                        role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session()->has('edit'))
                    <div class="alert alert-success text-light" role="alert">
                        <strong>
                            {{ session ('edit') }}
                        </strong>
                    </div>
                    @endif
                    {{--  --}}
                    <div class="mx-3">
                        <a href="/saldo-pdf" target="blank" class="btn bg-gradient-danger w-15 my-4 mb-2"><i class="bi bi-file-earmark-pdf-fill"></i>Cetak Pdf</a>
                        {{-- <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button> --}}
                        <a href="/saldo-data" blank class="btn bg-gradient-success w-15 my-4 mb-2"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Cetak Excel</a>
                        {{-- <a href="/admin/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr class="bg-dark">
                                    <th
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        No</th>
                                    <th style="width: 15%"
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        SALDO</th>
                                    <th
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7 ps-2">
                                        PEMAKAIAN/PENAMBAHAN</th>
                                    <th
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        SISA</th>
                                    <th style="width: 10%"
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($data as $data )
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="" style="width: 15%">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0 text-sm">@currency($data->saldo)</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0"> @currency($data->nominal)</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">@currency($data->hasil)</span>
                                        {{-- class="text-secondary text-xs font-weight-bold">{{$data->created_at->format('Y-m-d')}}</span>
                                        --}}
                                    </td>
                                    <td class="bg-info text-center">
                                        <div class="d-flex">
                                            <button class="btn btn-warning font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}"><i class="bi bi-pencil-square"></i></button>
                                            <form action="/admin/saldo/{{$data->id}}" method="post" class="">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger font-weight-bold m-auto" type="submit"
                                                    onclick="return confirm('Yakin akan menghapus data ?')"><i class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Saldo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/saldo">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder">Nama</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="Enter your name" name="saldo">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">nominal</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="Enter your nominal address" name="nominal">
                    {{-- </div>
                    <label class="text-xl text-dark font-weight-bolder">Jumlah</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="" name="hasil">
                    </div> --}}

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Save</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT --}}
@foreach ($saldo as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Saldo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/saldo/{{$data->id}}">
                @method('PUT')
                <div class="modal-body">
                    @csrf
                    <label class="text-xl text-dark font-weight-bolder">Saldo</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="Enter your name" name="saldo"
                            value="{{$data->saldo}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Nominal</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" id="nominal" placeholder=""
                            name="nominal" value="{{$data->nominal}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Jumlah</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="" name="hasil">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
@endsection
