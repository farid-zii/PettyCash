@foreach ($pangkat as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/pangkat/{{$data->id}}">
                @method('PUT')
                <div class="modal-body">
                    @csrf
                    <label class="text-xl text-dark font-weight-bolder">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" required name="nama" value="{{$data->nama}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Kode</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" required placeholder="" name="kode" value="{{$data->kode}}">
                    </div>

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-warning float-sm-start col-md-2 mt-4">Edit</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
