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

                    <div class="mx-3">
                        {{-- <input type="text" class="form-control" style="width: 30%" id="filter_date" value="{{ date('m-Y') }}"> --}}
                        {{-- <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button> --}}
                        <a href="/export-data" blank class="btn bg-gradient-success w-15 my-4 mb-2"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Cetak Excel</a>
                        {{-- <a href="/admin/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button>
                    </div>

                    <div class="p-3">
                    <table id="myTable" class="table table-striped display responsive nowrap">
                        <thead class="">
                        <tr class="text-center bg-dark">
                            <th class="text-light" style="width: 5%;">Kode</th>
                            <th class="text-light" style="width: 10%;">Nama/Departemen</th>
                            <th class="text-light" style="">Keterangan</th>
                            <th class="text-light" style="width: 9%;">Rekening</th>
                            <th class="text-light" style="width: 7%;">Debit</th>
                            <th class="text-light" style="width: 7%;">Kredit</th>
                            <th class="text-light text-center" style="width: 10%;" colspan="2">Aprrove</th>
                            <th class="text-light" style="width: 14%;" >Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pengajuan as $data )
                                <tr>
                                    <td class=""> {{$loop->iteration}}</td>
                                    <td class="">
                                        <p class="text-xl font-weight-bold mb-0">{{$data->pegawai->nama}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->pegawai->departemen->nama}}</p>
                                    </td>
                                    <td class="" style="width: 50px">{{$data->keterangan}}</td>
                                    <td class="">
                                        <p class="text-xs font-weight-bold mb-0">{{$data->norek}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->bank}}</p>
                                    </td>

                                    @if ($data->type==false)
                                    <td class="text-end">-</td>
                                    <td class="text-end">@rp($data->nominal)</td>
                                    @elseif ($data->type==true)
                                    <td class="text-end">@rp($data->nominal)</td>
                                    <td class="text-end">-</td>
                                    @endif
                                    {{--  --}}
                                    <td class="text-center">{{$data->approveF}}</td>
                                    {{--  --}}
                                    <td class="text-center">{{$data->approveD}}</td>
                                    {{--  --}}
                                    <td class="bg-info text-center">
                                        <div class="d-flex">
                                            <button class="btn btn-dark font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}"><i class="bi bi-eye-fill"></i></button>
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
                        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
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
@include('admin.pengajuan.edit')

<script>
     $(document).ready(function() {
      $('#myTable').DataTable({
        paging: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
      });



    });
</script>

@endsection
