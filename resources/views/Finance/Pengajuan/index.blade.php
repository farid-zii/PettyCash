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

                <div class="m-2">
                    @include('finance.notif')
                </div>

                <div class="m-2" style="">
                    <div class="bg-gradient-success  text-center my-4 mb-2 col-3 float-sm-start"
                        style="border-radius: 10px;color:white">
                        SALDO
                        <div>
                            RP. @rp($saldo)
                        </div>
                    </div>
                    {{-- <button class="btn bg-gradient-info w-15 my-4 mb-2 col-2 float-sm-end" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Entry <i class="bi bi-plus-square-fill"></i></button> --}}
                    {{-- <button class="btn bg-gradient-success w-15 my-4 mx-2 mb-2 col-2 float-sm-end"
                        data-bs-toggle="modal" data-bs-target="#static-excel"><i
                            class="bi bi-file-earmark-spreadsheet-fill"></i></button> --}}
                </div>



                <div class="ms-2" style="">

                    <form action="/pengajuan" method="get" style="display: flex">
                        <div class="col-2">
                            <label class="text-xl text-dark font-weight-bolder col-6">Tanggal Akhir</label>
                            <input type="date" id="tanggal" class="form-control ms-1" style="height: 30px" name="awal"
                                placeholder="dd-mm-yy" value="{{ request('awal') }}">
                        </div>
                        <div class="col-2 ms-1">
                            <label class="text-xl text-dark font-weight-bolder col-6">Tanggal Akhir</label>
                            <input type="date" id="tanggal2" style="height: 30px" class="form-control ms-1" name="akhir"
                                placeholder="dd-mm-yy" value="{{ request('akhir') }}">
                        </div>
                        <div class="col-3 mx-2">
                            <button type="submit" class="btn bg-gradient-info w-15 my-4 mb-2 col-2"><i
                                    class="bi bi-search"></i></button>
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
                                    <th class="text-light" style="">Nama/Departemen</th>
                                    <th class="text-light" style="">Rekening</th>
                                    <th class="text-light" style="">Nominal</th>
                                    <th class="text-light" style="">Keterangan</th>
                                    <th class="text-light text-center" style="" colspan="">Status</th>
                                </tr>
                            </thead>
                            <tbody id="ada">
                                @foreach ($pengajuan as $data )
                                <tr id="{{$data->id}}">
                                    <td class="text-center"> {{$loop->iteration}}</td>
                                    <td class="text-end"> {{$data->created_at->format('d-M-Y')}}</td>
                                    <td class="">
                                        <p class="text-xl font-weight-bold mb-0">{{$data->user->nama}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->user->departemen->nama}}</p>
                                    </td>
                                    <td class="">
                                        <p class="text-xs font-weight-bold mb-0">{{$data->norek}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->bank->nama}}</p>
                                    </td>
                                    <td class="text-end">
                                        @if ($data->nominalAcc!=null)
                                        @rp($data->nominalAcc)
                                        @else
                                        @rp($data->nominal)
                                        @endif

                                    </td>

                                    {{--  --}}
                                    <td class="" style="width: 50px"> {{ Str::words($data->keterangan, 2,'....')}}</td>
                                    <td class="text-center">
                                        @if($data->approve=='Menunggu')

                                            <button class="btn btn-success font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}-terima"><i class="bi bi-check-square-fill"></i></button>

                                            <button class="btn btn-danger font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}"><i class="bi bi-x-square-fill"></i></button>

                                        @elseif($data->approve=="Setuju"||$data->approve=="Dicairkan")
                                        <span class="bg-success p-2 fw-bold m-auto" style="border-radius: 10px;color:white;">Setuju</span>
                                        @else
                                        <span class="bg-danger p-2 fw-bold m-auto" style="border-radius: 10px;color:white;">{{$data->approve}}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CREATE -->
@include('finance.pengajuan.create')
@include('finance.pengajuan.view')
@include('finance.pengajuan.edit')

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

    //  $('#btnHapus').on('click',function() {
    //     hapus(id)
    //  })

    function Excel() {
        var awal = $('#tanggal1').val()
        var akhir = $('#tanggal2').val()
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken
        axios.post('web/cetak-excel', {
            awal: awal,
            akhir: akhir
        })
    }

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
