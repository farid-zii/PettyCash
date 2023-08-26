@extends('Pegawai.layouts.main')

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
                    @include('admin.notif')
                </div>

                <div class="m-2" style="">

                    @if ($cek=='Selesai')

                        <button class="btn bg-gradient-info w-15 my-4 mb-2 col-2 float-sm-end" onclick="alert('Selesaikan duluan pengajuan sebelumnya')">Tambah <i class="bi bi-plus-square-fill"></i></button>
                    @else
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 col-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Tambah <i class="bi bi-plus-square-fill"></i></button>


                      @endif
                    </div>
                    <div class="ms-2" style="">

                        <form action="/pegawai/pengajuan" method="get" style="display: flex">
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
                                    <th class="text-light" style="">Rekening</th>
                                    <th class="text-light" style="">Nominal</th>
                                    <th class="text-light" style="" colspan="">Status</th>
                                    <th class="text-light" style="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @foreach ($pengajuan as $data )
                                <tr id="">
                                    <td class="text-center"> {{$loop->iteration}}</td>
                                    <td class="text-end"> {{$data->created_at->format('d-M-Y')}}</td>
                                    {{-- <td class="">
                                        <p class="text-xl font-weight-bold mb-0">{{$data->user->nama}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->user->departemen->nama}}</p>
                                    </td> --}}
                                    <td class="" style="width: 50px"> {{ Str::words($data->keterangan, 3,'....')}}</td>
                                    <td class="">
                                        <p class="text-xl font-weight-bold mb-0">{{$data->norek}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->bank->nama}}</p>
                                    </td>
                                    <td class="text-end">
                                        @if ($data->nominalAcc !=null)
                                            @rp($data->nominalAcc)
                                        @else
                                            @rp($data->nominal)
                                        @endif
                                    </td>

                                    {{--  --}}
                                    <td class="text-center">
                                        @if ($data->approve=='Menunggu' || $data->approve=='Setuju')
                                        <span class="bg-info p-2 fw-bold" style="border-radius:10px;color:white">Menuggu</span>
                                        @elseif ($data->approve=='Dicairkan')
                                        <span class="bg-success p-2 fw-bold text-light" style="border-radius:10px;">{{$data->approve}}</span>
                                        @elseif ($data->approve=='Selesai')
                                        <span class="bg-primary p-2 fw-bold text-light" style="border-radius:10px;">{{$data->approve}}</span>
                                        @else
                                        <span class="bg-danger p-2 fw-bold text-light" style="border-radius:10px;">{{$data->approve}}</span>
                                        @endif
                                    </td>

                                    <td class=" text-center">
                                        <div class="d-flex">
                                            <button class="btn btn-dark font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}-view"><i
                                                    class="bi bi-eye-fill"></i></button>

                                            @if ($data->approve =='Menunggu')
                                            <button class="btn btn-warning font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#data-{{$data->id}}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <form method="post" action="/pegawai/pengajuan/{{$data->id}}" class="m-auto">
                                                @method('Delete')
                                                @csrf
                                                <button class="btn btn-danger font-weight-bold m-auto" type="submit" onclick="return confirm('Yakin akan menghapus data ?')"><i class="bi bi-trash3-fill"></i></button>
					                        </form>

                                            @endif
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
@include('Pegawai.pengajuan.create')
@include('Pegawai.pengajuan.view')
@include('Pegawai.pengajuan.edit')


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

    function formatNumber(input) {
    // Remove non-numeric characters
    input.value = input.value.replace(/\D/g, '');

    let formattedValue = '';
    let value = input.value;

    for (let i = 0; i < value.length; i++) {
      if (i > 0 && i % 4 === 0) {
        formattedValue += ' ';
      }
      formattedValue += value[i];
    }

    input.value = formattedValue;
  }
</script>

@endsection
