@foreach ($pengajuan as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/pegawaai/{{$data->id}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body row g-2">
                    {{-- <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder">Agama</label>
                        <select class="form-select" name="agama" required style="">
                            <option selected value="Laki-Laki">Islam</option>
                            <option selected value="Perempuan">Perempuan</option>
                        </select>
                    </div> --}}
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
