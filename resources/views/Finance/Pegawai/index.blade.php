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

                    <div class="table-responsive m-3">
                        <table id="myTable" class="table align-items-center mb-0 table-bordered border-dark" style="">
                            <thead>
                                <tr class="bg-dark" style="font-color:white;">
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7" style="width: 5%">
                                        No</th>
                                    <th style=""
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Nama</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        NIP</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Departemen</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        No. Handphone</th>
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Jenis Kelamin</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($user as $data )
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$data->nama}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$data->email}}</p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <p class="align-middle"> {{$data->nip}}</p>
                                    </td>
                                    <td class="">
                                        {{-- <p class="align-middle"> {{$deptData->nama}}</p> --}}
                                        <p class="align-middle"> {{$data->departemen->nama}}</p>
                                    </td>
                                    <td class="">
                                        <p class="text-xl mb-0">{{$data->phone}}</p>
                                    </td>
                                    <td class="">
                                        <p class="text-xl mb-0">{{$data->jenisKelamin}}</p>
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

{{-- EDIT --}}


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
@endsection