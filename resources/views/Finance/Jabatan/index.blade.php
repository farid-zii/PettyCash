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

                <div class="mx-3">
                        {{-- <a href="/admin/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive px-3">
                        <table class="table table-bordered border-dark" style="">
                            <thead>
                                <tr class="bg-dark" style="font-color:white;">
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        No</th>
                                    <th style=""
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        NAMA Jabatan</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        KODE</th>
                                    <th style="width: 10%"
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @if($jabatan->count())
                                @foreach ($jabatan as $data )
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
                                {{$jabatan->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CREATE -->
@include('admin.jabatan.create')

{{-- EDIT --}}
@include('admin.jabatan.edit')

{{-- Delete --}}
@include('admin.jabatan.delete')


@endsection
