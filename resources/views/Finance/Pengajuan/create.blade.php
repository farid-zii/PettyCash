@foreach ($pengajuan as $data)
<div class="modal fade" dty id="data-{{$data->id}}-terima" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Approve Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post"  action="/finance/pengajuan/{{$data->id}}" >
                @method('put')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder col-6">Keterangan</label>
                    <div class="mb-2">
                        <textarea type="text" readonly class="form-control" id="namaa" name="" value="" placeholder="">{{$data->keterangan}}</textarea>
                    </div>
                    <input type="hidden" value="1" name="tipe">
                    <label class="text-xl text-dark font-weight-bolder">Nominal</label>
                    <div class="mb-2" style="display:flex;">
                        <div class="form-control text-center" disabled style="width: 7%;background: rgb(223, 219, 219);">Rp</div>
                        <input type="number" class="form-control"  name="nominalAcc" id="nominal" value="{{$data->nominal}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Keterangan Approve</label>
                    <div class="mb-2">
                        <textarea type="text" class="form-control" id="namaa" name="komen" value="" placeholder=""></textarea>
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Approve</button>
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
