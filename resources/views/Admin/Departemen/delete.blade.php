@foreach ($datas as $data)
<div class="modal fade" dty id="delete-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h1 class="modal-title fs-5 fw-bolder text-light" id="staticBackdropLabel">Delete Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/hrd/departemen/{{$data->id}}">
                @method('Delete')
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="text-xl text-dark font-weight-bolder">Nama</label>
                        <input class="form-control col-mb-3" disabled value="{{$data->nama}}">
                    </div>
                    <div class="form-group">
                        <label class="text-xl text-dark font-weight-bolder">Kode</label>
                        <input class="form-control col-mb-3" disabled value="{{$data->kode}}">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-danger float-sm-start col-md-2 mt-4 me-3">delete</button>
                    <button type="button" class="btn btn-info float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
