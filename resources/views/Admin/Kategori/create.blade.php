<div class="modal fade" dty id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Entry Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="/admin/KategoriPgw">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder" required>Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="" name="nama" value="{{old('kode')}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder ">Kode</label>
                    <div class="mb-2">
                        <input type="text" class="form-control " placeholder="" id='kode' required name="kode" value="{{old('kode')}}">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Save</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-dark float-sm-end col-md-2 mt-4 me-3">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
