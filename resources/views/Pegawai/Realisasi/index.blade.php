@extends('pegawai.layouts.main')

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

                <div class="m-2">
                    @include('pegawai.notif')
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
                                    <th class="text-light" style="">Keterangan</th>
                                    <th class="text-light" style="">Nominal</th>
                                    <th class="text-light" style="">Total Pemakaian</th>
                                    <th class="text-light" style="">Refund</th>
                                    <th class="text-light" style="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="ada">
                                @foreach ($pengajuan as $data )
                                <tr id="">
                                    <td class="text-center"> {{$loop->iteration}}</td>
                                    {{-- <td class="">
                                        <p class="text-xl font-weight-bold mb-0">{{$data->user->nama}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->user->departemen->nama}}</p>
                                    </td> --}}

                                    <td class="" style="width: 50px">{{ Str::words($data->keterangan, 2,'....')}}</td>


                                    <td class="text-end" id="debit">@rp($data->nominalAcc)</td>


                                    <td class="text-end">
                                        @if ($data->total!=null)
                                            @rp($data->total)
                                        @else
                                            -
                                        @endif
                                        </td>

                                    <td class="text-end">
                                        @if ($data->refund!=null)
                                            @rp($data->refund)
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td class=" text-center">
                                        <div class="d-flex">
                                            <button class="btn btn-dark font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}-view"><i
                                                    class="bi bi-eye-fill"></i></button>
                                            @if ($data->approve!='Selesai')
                                            <button class="btn btn-success font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#data-{{$data->id}}"><i class="bi bi-plus-square-fill"></i></button>
                                                
                                            @endif
                                            {{-- <form method="post" action="/hrd/realisasi/{{$data->id}}" class="m-auto">
                                                @method('Delete')
                                                @csrf
                                                <button class="btn btn-danger font-weight-bold m-auto" type="submit" onclick="return confirm('Yakin akan menghapus data ?')"><i class="bi bi-trash3-fill"></i></button>
					                        </form> --}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th class="text-center" colspan="3">Total</th>
                                    <td class="text-end">@rp($debit)</td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CREATE -->
@include('pegawai.realisasi.create')
@include('pegawai.realisasi.view')
@include('pegawai.realisasi.edit')

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
    var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    let token = $("meta[name='csrf-token']").attr("content");

    var pilihId = ''

    $("#myTable tbody tr").on("click", function () {
        // Menghapus kelas CSS pada semua baris
        $("#myTable tbody tr").removeClass("selected");

        // Menambahkan kelas CSS pada baris yang dipilih
        $(this).addClass("selected");

        pilihId = $(this).attr("id");

    });



    function hapus(id) {

        Swal.fire({
            title: 'Apakah kamu yakin',
            text: "ingin menghapus data  ini",
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'YA, HAPUS!',
            cancelButtonText: 'TIDAK',
        }).then((result) => {
            if (result.isConfirmed) {

                axios.delete(`api/pengajuan-del/${id}`).then(() => {

                    Swal.fire({
                        title: 'Data Berhasil Dihapus',
                        icon: 'success',
                        timer: 2000,
                    })
                })
                location.reload();
                // $(`#index_${id}`).remove();
            }
        })
    }

</script>

@endsection
