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
                @include('Admin.notif')

                <div class="mx-4">
                    <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                </div>

                <div class="card-body px-4 pb-2 row">
                    <div class="table-responsive px-4">
                        <table class="ol-12 table table-striped display responsive nowrap" id="myTable" style="">
                            <thead>
                                <tr class="bg-dark" style="font-color:white;">
                                    {{-- <th class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        No</th> --}}
                                    {{-- <th style="" class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        {{$title}}</th> --}}

                                    <th class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        NO</th>
                                    <th class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Keterangan</th>
                                    <th class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Hasil</th>
                                    <th style="width: 10%"
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($datas as $data )
                                <tr class="">
                                    <td class="">
                                        <p class="text-start"> {{$loop->iteration}}</p>
                                    </td>
                                    <td class="">
                                        <p class="">Saldo ditambahakan sebanyak Rp. <span class="fw-bold">@rp($data->saldo)</span> pada tanggal {{$data->created_at->format('d-M-Y')}} </p>
                                    </td>
                                    <td class="">
                                        <p class="text-start"> @rp($data->total)</p>
                                    </td>
                                    <td class="">
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
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {


        $('#myTable').DataTable({
            paging: true,
            pageLength: 10,
            // scrollX:true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            language: {
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang cocok",
                search: "Cari:",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: ">",
                    previous: "<"
                }
            }
        });


    });
</script>


<!-- CREATE -->


@include('admin.Saldo.create')
@include('admin.Saldo.edit')

{{-- EDIT --}}



@endsection
