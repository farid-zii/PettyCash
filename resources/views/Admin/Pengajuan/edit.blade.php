@foreach ($pengajuan as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="/hrd/pengajuan-edit" method="post" >
                {{-- @method('put') --}}
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder col-6">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$data->user->nama}}" readonly>
                        <input type="hidden" class="form-control" id="nama" name="id" value="{{$data->id}}" readonly>
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">Nominal</label>
                    <div class="mb-2" style="display:flex;">
                        <div class="form-control text-center" disabled style="width: 7%;background: rgb(223, 219, 219);">Rp</div>
                        <input type="number" class="form-control" placeholder="300" name="nominal" id="nominal" value="{{$data->nominal}}">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nominal"></div>
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">No. Rekening</label>
                    <div class="mb-2" style="display:flex;">
                        <select name="bank" id="bank" style="width: 20%;background: rgb(223, 219, 219);">
                            @foreach ($bank as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                        <input type="number" class="form-control" placeholder="300" name="norek" id="norek" value="{{$data->norek}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Keterangan</label>
                    <div class="mb-2">
                        <textarea class="form-control" name="keterangan" id="keterangan" onkeydown="">{{$data->keterangan}}</textarea>
                    </div>
                    {{-- <label class="text-xl text-dark font-weight-bolder">Jumlah</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="" name="hasil">
                     </div>/// --}}

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Save</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
</script>
@endforeach
