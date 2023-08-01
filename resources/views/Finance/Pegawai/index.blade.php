@extends('finance.layouts.main')

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

{{-- @include('finance.notif') --}}

                    <div class="mx-3">
                        <a href="/departemen-pdf" target="blank" class="btn bg-gradient-danger w-15 my-4 mb-2"><i
                                class="bi bi-file-earmark-pdf-fill"></i></a>
                        {{-- <a href="/departemen-pdf" target="blank" class="btn bg-gradient-danger w-15 my-4 mb-2"><i
                                class="bi bi-file-earmark-pdf-fill"></i>Cetak Pdf</a> --}}
                        {{-- <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button> --}}
                        {{-- <a href="/departemen-data" target="blank" class="btn bg-gradient-success w-16 my-4 mb-2"><i
                                class="bi bi-file-earmark-spreadsheet-fill"></i> Cetak Excel</a> --}}
                        {{-- <a href="/finance/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                    </div>
                    <div class="table-responsive m-3">
                        <table class="table align-items-center mb-0 table-bordered border-dark" style="">
                            <thead>
                                <tr class="bg-dark" style="font-color:white;">
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7" style="width: 5%">
                                        No</th>
                                    <th style=""
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        {{$title}}</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        NIP</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        UMUR</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Jabatan</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @if($pegawai->count())
                                @foreach ($pegawai as $data )
                                <tr>
                                    <td class="text-center">{{$nomorUrut++}}</td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="@if($data->profil!= '') ../img/profil_Pegawai/{{$data->profil}} @else https://cdn-icons-png.flaticon.com/512/3135/3135715.png  @endif " class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$data->nama}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$data->email}}</p>
                                        </div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <p class="align-middle"> {{$data->nip}}</p>
                                    </td>
                                    <td class="">
                                        <p class="align-middle"> {{$data->umur}}</p>
                                    </td>
                                    <td class="">
                                        <p class="text-xs font-weight-bold mb-0">{{$data->jabatan->nama}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->departemen->nama}}</p>
                                    </td>
                                    {{-- <td class="">
                                        <p class="align-middle"> {{$data->created_at->format('ymd')-$data->created_at->format('ymd')}}</p>
                                    </td> --}}
                                    {{-- <td class="bg-info">
                                        <div class="d-flex">
                                            <button class="btn btn-success font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#data-{{$data->id}}">
                                                <i class="bi bi-eye-fill"></i></button>
                                            <button class="btn btn-warning font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#data-{{$data->id}}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#delete-{{$data->id}}"><i
                                                    class="bi bi-trash3-fill"></i></button>
                                        </div>
                                    </td> --}}
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
                                {{$pegawai->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CREATE -->

{{-- EDIT --}}

@include('finance.Pegawai.create')
@include('finance.Pegawai.delete')
@include('finance.Pegawai.edit')
@endsection
