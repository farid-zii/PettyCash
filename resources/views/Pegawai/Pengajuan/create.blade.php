<div class="modal fade" dty id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Pengajuan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/pegawai/pengajuan">
                @method('POST')
                @csrf
                <div class="modal-body">

                    <label class="text-xl text-dark font-weight-bolder col-6">Nama</label>
                    <div class="mb-2">

                        <input type="text" class="form-control " style="" value="{{auth()->user()->nama}}" name="nama" readonly>
                        <input type="hidden" class="form-control " style="" value="{{auth()->user()->id}}" name="user_id" readonly>
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">Nominal</label>
                    <div class="mb-2" style="display:flex;">
                        <div class="form-control text-center" disabled style="width: 7%;background: rgb(223, 219, 219);">Rp</div>
                        <input type="number" class="form-control" placeholder="300" name="nominal" id="nominal">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nominal"></div>
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">No. Rekening</label>
                    <div class="mb-2" style="display:flex;">
                        <select name="bank" id="bank" style="width: 20%;background: rgb(223, 219, 219);">
                            @foreach ($bank as $data)
                            <option value="{{$data->id}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                        <input type="text" oninput="formatNumber(this)" maxlength="19" class="form-control" required placeholder="" name="norek" id="norek">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Keterangan</label>
                    <div class="mb-2">
                        <textarea class="form-control" name="keterangan" id="keterangan" onkeydown="addNumberOnEnter(event)" required></textarea>
                    </div>
                    {{-- <label class="text-xl text-dark font-weight-bolder">Jumlah</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="" name="hasil">
                     </div>/// --}}

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4" >Simpan</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" dty id="static-excel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cetak Pengajuan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/cetak-excel">
                @csrf
                <div class="modal-body">

                    <label class="text-xl text-dark font-weight-bolder col-6">Tanggal Awal</label>
                    <div class="mb-2">
                        <input type="date" class="form-control" id="nama" name="awal">
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>
                    <label class="text-xl text-dark font-weight-bolder col-6">Tanggal Akhir</label>
                    <div class="mb-2">
                        <input type="date" class="form-control" id="nama" name="akhir">
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4" >Cetak</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
</script>
