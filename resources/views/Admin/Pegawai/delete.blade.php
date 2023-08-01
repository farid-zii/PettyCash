@foreach ($pegawai as $data)
<div class="modal fade" dty id="delete-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h1 class="modal-title fs-5 fw-bolder text-light" id="staticBackdropLabel">Delete Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/hrd/pegawaai/{{$data->id}}">
                @method('Delete')
                @csrf
                <div class="modal-body row g-2">
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder" required>Nama</label>
                        <input type="text" class="form-control" disabled name="nama" value="{{$data->nama}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Nip</label>
                        <input type="number" class="form-control " disabled id='nip' required name="nip"
                            value="{{$data->nip}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Email</label>
                        <input type="text" class="form-control " disabled id='email' required name="email"
                            value="{{$data->email}}">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-danger float-sm-start  mt-4 text-center">delete</button>
                    <button type="button" class="btn btn-info float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
