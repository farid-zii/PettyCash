@foreach ($pengajuan as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Bukti</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="/pegawai/realisasi" method="post" enctype="multipart/form-data" >
            {{-- <form  action="/pengajuan-edit/{{$data->id}}" method="put" enctype="multipart/form-data"> --}}
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder col-6">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="namaa" name="nama" value="{{$data->user->nama}}" readonly>
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$data->id}}" readonly>
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">Keterangan</label>
                    <div class="mb-2">
                        <textarea class="form-control" name="keterangan" id="keterangan" onkeydown="" readonly>{{$data->keterangan}}</textarea>
                    </div>


                    <label class="text-xl text-dark font-weight-bolder">Terpakai</label>
                    <div class="mb-2" style="display:flex;">
                        <div class="form-control text-center" disabled style="width: 7%;background: rgb(223, 219, 219);">Rp</div>
                        <input type="number" class="form-control" placeholder="300" name="terpakai" id="nominal" value="{{$data->nominalAcc}}" max="{{$data->nominalAcc}}">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nominal"></div>
                    </div>

                    <label class="text-xl text-dark font-weight-bolder col-6">Bukti Pemakaian</label>
                    <input type="file" class="form-control"  name="bukti_pakai" accept="image/*" multiple required>

                    <label class="text-xl text-dark font-weight-bolder col-6">Bukti Pengembalian</label>
                    <input type="file" class="form-control"  name="bukti_refund" accept="image/*" multiple >


                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-info float-sm-start col-md-2 mt-4">Tambah</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Masukkan ini di bagian bawah halaman Anda -->
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>
<script>

    var i = 0;
        $('#add').click(function(){
            ++i;
            $('#tabelBukti').append(
                `<tr>
                    <td width="90%"><input type="File" class="form-control" name="inputs[+i+][gambars]" placeholder="masukkan nama"></td>
                    <td width="10%"><button type="button" class="btn btn-danger remove-table-row">-</button></td>
                </tr>`
            );
        });

        $(document).on('click','.remove-table-row', function(){
            $(this).parents('tr').remove();
        });

</script>



@endforeach
