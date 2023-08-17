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
                    <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive px-3">
                        <table id="myTable" class="table table-bordered border-dark" style="">
                            <thead>
                                <tr class="bg-dark" style="font-color:white;">
                                    <th
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        No</th>
                                    <th style=""
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        NAMA {{$title}}</th>
                                    <th style="width: 10%"
                                        class="text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="" class="table-departemen">
                                @foreach ($datas as $data )
                                <tr id="index_{{$data->id}}">
                                    <td class="">{{$loop->iteration}}</td>
                                    <td class="" style="">
                                        <p class="align-middle">{{$data->nama}}</p>
                                    </td>
                                    <td class="">
                                        <div class="d-flex">
                                            <button class="btn btn-warning font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#data-{{$data->id}}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <form method="post" action="/hrd/bank/{{$data->id}}">
                                                @method('Delete')
                                                @csrf
                                                <button class="btn btn-danger font-weight-bold m-auto" type="submit" onclick="return confirm('Yakin akan menghapus data ?')"><i class="bi bi-trash3-fill"></i></button>
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
@include('Admin.bank.create')
{{-- EDIT --}}
@include('Admin.bank.edit')
{{-- Delete --}}

<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            paging: true,
            pageLength: 10,
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
