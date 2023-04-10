@foreach ($pegawai as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/pegawai/{{$data->id}}">
                @method('PUT')
                <div class="modal-body row g-2">
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder" required>Nama</label>
                        <input type="text" class="form-control" placeholder="" name="nama" value="{{$data->nama}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Nip</label>
                        <input type="number" class="form-control " placeholder="" id='nip' required name="nip"
                            value="{{$data->nip}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Email</label>
                        <input type="text" class="form-control " placeholder="" id='email' required name="email"
                            value="{{$data->email}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Tanggal Lahir</label>
                        <input type="date" class="form-control " placeholder="" required name="tgl_lahir"
                            value="{{$data->tgl_lahir}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Photo Profile</label>
                        <input type="file" class="form-control" accept="image/png, image/gif, image/jpeg" required name="profil"
                            value="{{$data->profil}}">
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Jenis Kelamin</label>
                        <select class="form-select" name="j_kelamin" required style="">
                            <option selected value="Laki-Laki">Laki-Laki</option>
                            <option selected value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Agama</label>
                        <input type="text" class="form-control " required name="agama"
                            value="{{$data->agama}}">
                    </div>
                    {{-- <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder">Agama</label>
                        <select class="form-select" name="agama" required style="">
                            <option selected value="Laki-Laki">Islam</option>
                            <option selected value="Perempuan">Perempuan</option>
                        </select>
                    </div> --}}
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Departemen</label>
                        <select class="form-select" required name="departemen_id">
                            @foreach ($departemen as $item)
                            <option selected value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Jabatan</label>
                        <select class="form-select" required name="jabatan_id">
                            @foreach ($jabatan as $item)
                            <option selected value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Pangkat</label>
                        <select class="form-select" required name="pangkat_id">
                            @foreach ($pangkat as $item)
                            <option selected value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Kategori Pegawai</label>
                        <select class="form-select" required style="">
                            @foreach ($kategori as $item)
                            <option selected value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
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
