<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12x;
    }

    h6 {
        font-size: 17px;
        text-align: center;
    }

    .text-white {
        text-align: center;
    }

    #myTable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    #myTable th,
    #myTable td {
        padding: 10px;
    }

    #myTable th {
        background-color: #dadada;
        font-weight: bold;
    }

    #myTable td {
        text-align: left;
    }

    #myTable th {
        text-align: left
    }

    #myTable tr .label {
        text-align: right
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    table,
    th,
    td {
        border: 1px solid #c2bfbf;

        th,
        td {
            padding: 8px;

            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid #dadada;
            /* Warna dan ketebalan garis sesuaikan dengan preferensi Anda */
        }

        th,
        td {
            padding: 8px;
            /* Sesuaikan sesuai kebutuhan Anda */
            text-align: left;
        }
    }
</style>









<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0 position-relative">
                        <img src="../public/img/logo.jfif" alt="" width="18%">
                        <h6 style="margin-top: -3px;">PT. Jasamedika Saranatama</h6>
                        <h6 style="margin-top: -30px;">DATA PENGAJUAN</h6>
                    </div>
                    <hr>
                    <div class="m-2" style="">

                        {{-- <button class="btn bg-gradient-success w-15 my-4 mx-2 mb-2 col-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#static-excel"><i class="bi bi-file-earmark-spreadsheet-fill"></i></button> --}}
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="p-3" style="">
                            <table id="myTable" style=""
                                class="col-12 table table-striped display responsive nowrap">
                                <thead class="">
                                    <tr class="text-center bg-dark">
                                        <th class="text-light" style="">No</th>
                                        <th class="text-light" style="">Tanggal</th>
                                        <th class="text-light" style="">Nama</th>
                                        <th class="text-light" style="">Keterangan</th>
                                        <th class="text-light" style="">No Rekening</th>
                                        <th class="text-light" style="">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @foreach ($pengajuan as $data)
                                            <tr>
                                                <td>
                                                    <p class="text-xl  mb-0">{{ $loop->iteration }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xl text-end mb-0">
                                                        {{ $data->created_at->format('m-d-Y') }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xl mb-0">{{$data->user->nama}}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xl mb-0">{{$data->keterangan}}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xl mb-0">{{$data->norek}}</p>
                                                    <p class="text-xl mb-0">{{$data->bank->nama}}</p>
                                                </td>

                                                <td>
                                                    <p class="text-xl mb-0 text-end"> @rp($data->nominal)</p>
                                                </td>
                                            </tr>

                                    @endforeach
                                </tbody>
                                {{-- <tfoot>
                                    <tr>
                                        <td colspan='4' style="text-align: center">Jumlah</td>
                                        <td style="text-align: right">{{$pengajuan->totalPengajuan}}</td>
                                        <td style="text-align: right">{{$saldo->totalSaldo}}</td>
                                    </tr>
                                </tfoot> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {


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
</body>
