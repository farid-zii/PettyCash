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

                <div class="m-2" style="">

                    {{-- <button class="btn bg-gradient-success w-15 my-4 mx-2 mb-2 col-2 float-sm-end" data-bs-toggle="modal"
                        data-bs-target="#static-excel"><i class="bi bi-file-earmark-spreadsheet-fill"></i></button> --}}
                </div>



                    <div class="ms-2" style="">

                        <form action="/pengajuan" method="get" style="display: flex">
                            <div class="col-2">
                                <label class="text-xl text-dark font-weight-bolder col-6">Tanggal Akhir</label>
                                <input type="date" id="tanggal" class="form-control ms-1" style="height: 30px" name="awal" placeholder="dd-mm-yy" value="{{ request('awal') }}">
                            </div>
                            <div class="col-2 ms-1">
                                <label class="text-xl text-dark font-weight-bolder col-6">Tanggal Akhir</label>
                                <input type="date" id="tanggal2" style="height: 30px" class="form-control ms-1" name="akhir" placeholder="dd-mm-yy" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-3 mx-2">
                                <button type="submit" class="btn bg-gradient-info w-15 my-4 mb-2 col-2"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>

                <div class="card-body px-0 pb-2">



                    <div class="p-3" style="">
                        <table id="myTable" style="" class="col-12 table table-striped display responsive nowrap">
                            <thead class="">
                                <tr class="text-center bg-dark">
                                    <th class="text-light" style="">No</th>
                                    <th class="text-light" style="">Tanggal</th>
                                    <th class="text-light" style="">Keterangan</th>
                                    <th class="text-light" style="">Pihak Terkait</th>
                                    <th class="text-light" style="">Debit</th>
                                    <th class="text-light" style="">Kredit</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @foreach ($datas as $data )
                                    @if($data->pengajuan_id!=null)
                                        <tr>
                                            <td>
                                                <p class="text-xl  mb-0">{{$loop->iteration}}</p>
                                            </td>
                                            <td>
                                                <p class="text-xl  mb-0 text-end">{{$data->created_at->format('Y-m-d')}}</p>
                                            </td>
                                            <td>
                                                <p class="text-xl  mb-0">{{$data->pengajuan->keterangan}}</p>
                                            </td>
                                            <td>
                                                <p class="text-xl  mb-0">{{$data->pengajuan->user->nama}}</p>
                                            </td>
                                            <td>
                                                <p class="text-xl  mb-0 text-end">@rp($data->pengajuan->total)</p>
                                            </td>
                                            <td>
                                                <p class="text-xl  mb-0">-</p>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <p class="text-xl  mb-0">{{$loop->iteration}}</p>
                                            </td>
                                            <td>
                                                <p class="text-xl text-end mb-0">{{$data->created_at->format('Y-m-d')}}</p>
                                            </td>
                                            <td>
                                                <p class="text-xl mb-0">Top Up</p>
                                            </td>
                                            <td>
                                                <p class="text-xl mb-0">Finance</p>
                                            </td>
                                            <td>
                                                <p class="text-xl mb-0">-</p>
                                            </td>
                                            <td>
                                                <p class="text-xl mb-0 text-end">@rp($data->saldo->saldo)</p>
                                            </td>
                                        </tr>
                                    @endif
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

@endsection
