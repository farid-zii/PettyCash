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
                            <th class="text-light" style="width: 10%;">Kode</th>
                            <th class="text-light" style="width: 15%;">Nama/Departemen</th>
                            <th class="text-light" style="">Project</th>
                            <th class="text-light" style="width: 9%;">Rekening</th>
                            <th class="text-light" style="width: 8%;">Debit</th>
                            <th class="text-light" style="width: 8%;">Kredit</th>
                            <th class="text-light" style="">Uraian</th>
                            <th class="text-light text-center" style="width: 10%;" colspan="">Aprrove</th>
                            <th class="text-light" style="width: 14%;" >Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pengajuan as $data )
                                <tr id="index_{{$data->id}}">
                                    <td class=""> {{$data->kode}}</td>
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
                                    <td class="" style="width: 50px">{{$data->keterangan}}</td>
                                    <td class="text-center">{{$data->approveF}}</td>
                                    {{--  --}}
                                    {{--  --}}
                                    <td class="bg-info text-center">
                                        <div class="d-flex">
                                            <button class="btn btn-dark font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}-view"><i class="bi bi-eye-fill"></i></button>
                                            <button class="btn btn-warning font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger font-weight-bold m-auto" onclick="hapus({{$data->id}})"><i class="bi bi-trash3-fill"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                        </tbody>
                        <tfoot>
                            <tr>
                            <th class="text-center" colspan="4">Total</th>
                            <td class="text-end">@rp($kredit)</td>
                            <td class="text-end">@rp($debit)</td>
                            <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CREATE -->
@include('admin.pengajuan.create')
@include('admin.pengajuan.view')
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
                next: ">",
                previous: "<"
            }
        }
      });

    });

    // function load() {
    //     axios.get('api/get-pengajuan').then((response)=>{
    //         let data = response.data
    //         let table = $('#myTable tbody')

    //         $.each(data,function(index, item) {
    //             let row = $(`<tr></tr>`)

    //             row.append($(`<td></td>`).text(data.nama))
    //             row.append($(`<td></td>`).text(data.nama))
    //             row.append($(`<td></td>`).text(data.nama))
    //             row.append($(`<td></td>`).text(data.nama))

    //             table.append(row);
    //         })

    //     }).catch(()=>{
    //         console.log('gaggal')
    //     }

    //     )
    // }

    var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    let token = $("meta[name='csrf-token']").attr("content");
    function hapus(id) {
        Swal.fire({
            title:'Apakah kamu yakin',
			text: "ingin menghapus data  ini",
			icon: 'warning',
			showConfirmButton:true,
            showCancelButton: true,
			confirmButtonText: 'YA, HAPUS!',
            cancelButtonText:'TIDAK',
        }).then((result)=>{
            if(result.isConfirmed){

                axios.delete(`api/pengajuan-del/${id}`).then(()=>{

                    Swal.fire({
                        title:'Data Berhasil Dihapus',
			            icon: 'success',
			            timer: 2000,
                    })
                })
                $(`#index_${id}`).remove();
            }
        })
      }
</script>

@endsection
