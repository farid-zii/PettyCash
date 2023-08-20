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

                <div class="m-2">
                    @include('admin.notif')
                </div>

                <div class="m-2" style="">
                    {{-- <input type="text" class="form-control" style="width: 30%" id="filter_date" value="{{ date('m-Y') }}">
                    --}}
                    {{-- <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button> --}}

                    {{-- <a href="/admin/user/create"  class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end">Entry</a> --}}

                    <div class="bg-gradient-success  text-center my-4 mb-2 col-3 float-sm-start"
                        style="border-radius: 10px;color:white">
                        SALDO
                        <div class="fw-bold" style="color: black;font-size: 17px" >
                            RP. @rp($saldo)
                        </div>
                    </div>
                    <button class="btn bg-gradient-info w-15 my-4 mb-2 col-2 float-sm-end" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Tambah <i class="bi bi-plus-square-fill"></i></button>
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
                                    <th class="text-light" style="">Nama/Departemen</th>
                                    <th class="text-light" style="">Rekening</th>
                                    <th class="text-light" style="">Nominal</th>
                                    <th class="text-light" style="">Keterangan</th>
                                    <th class="text-light" style="" colspan="">Status</th>
                                    <th class="text-light" style="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @foreach ($pengajuan as $data )
                                <tr id="">
                                    <td class="text-center"> {{$loop->iteration}}</td>
                                    <td class="">
                                        <p class="text-xl font-weight-bold mb-0">{{$data->user->nama}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$data->user->departemen->nama}}</p>
                                    </td>
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
                                    <td class="" style="width: 50px"> {{ Str::words($data->keterangan, 2,'....')}}</td>
                                    <td class="text-center">
                                        @if ($data->approve=='Menunggu')
                                        <span class="bg-info p-2 fw-bold" style="border-radius:10px;color:white">{{$data->approve}}</span>
                                        @elseif ($data->approve=='Setuju')
                                        <form method="post" action="/hrd/pengajuan/{{$data->id}}">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="type" value="2">
                                            <button class="bg-success fw-bold text-light p-2">Cairkan</button>
                                        </form>
                                        @elseif ($data->approve=='Dicairkan')
                                        <span class="bg-success p-2 fw-bold text-light" style="border-radius:10px;">{{$data->approve}}</span>
                                        @elseif ($data->approve=='Selesai')
                                        <span class="bg-primaryp-2 fw-bold text-light" style="border-radius:10px;">{{$data->approve}}</span>
                                        @else
                                        <span class="bg-danger p-2 fw-bold text-light" style="border-radius:10px;">{{$data->approve}}</span>

                                        @endif
                                    </td>

                                    <td class=" text-center">
                                        <div class="d-flex">
                                            <button class="btn btn-dark font-weight-bold m-auto" data-bs-toggle="modal"
                                                data-bs-target="#data-{{$data->id}}-view"><i
                                                    class="bi bi-eye-fill"></i></button>
                                            <button class="btn btn-warning font-weight-bold m-auto"
                                                data-bs-toggle="modal" data-bs-target="#data-{{$data->id}}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <form method="post" action="/hrd/pengajuan/{{$data->id}}" class="m-auto">
                                                @method('Delete')
                                                @csrf
                                                <button class="btn btn-danger font-weight-bold m-auto" type="submit" onclick="return confirm('Yakin akan menghapus data ?')"><i class="bi bi-trash3-fill"></i></button>
					                        </form>
                                            {{-- <button class="btn btn-danger font-weight-bold m-auto"
                                                onclick="hapus({{$data->id}})"><i
                                                    class="bi bi-trash3-fill"></i></button> --}}
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
@include('admin.pengajuan.view')
@include('admin.pengajuan.edit')


<script>
$(document).ready(function() {
    // Initialize the Typeahead.js autocomplete
    var namaInput = $('#nama');
    var namaData = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/api/searchNama?keyword=%QUERY',
            wildcard: '%QUERY'
        }
    });

    namaInput.typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'nama-autocomplete',
            display: 'nama',
            source: namaData,
            templates: {
                suggestion: function(data) {
                    return '<div class="custom-suggestion" style="z-index: 999; background: #c3bdbd; ; width: 120%;">' + data.nama + '</div>';
                },
            }
        }
    );
});

// Rest of your code
$('#nama').on('typeahead:selected', function(event, suggestion, dataset) {
    // Do something when a suggestion is selected
    console.log(suggestion);
});



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
