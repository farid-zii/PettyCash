@foreach ($user as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/hrd/pegawai/{{$data->id}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body row g-2">
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder" required>Nama</label>
                        <input type="text" class="form-control" placeholder="" name="nama" value="{{$data->nama}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder" required>Username</label>
                        <input type="text" class="form-control" placeholder="" name="username" value="{{$data->username}}">
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Level User</label>
                        <select class="form-select" required name="level">
                            <option value="hrd">HRD</option>
                            <option value="finance">Finance</option>
                            <option selected value="pegawai">Pegawai</option>
                            <option value="pimpinan">Pimpinan</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Nip</label>
                        <input type="text" class="form-control " placeholder="" required name="nip"
                            value="{{$data->nip}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">No Hanphone</label>
                        <input type="number" class="form-control " placeholder="" id='nip' required name="phone"
                            value="{{$data->phone}}">
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Jenis Kelamin</label>
                        <select class="form-select" name="kelamin" required style="">
                            <option selected value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Departemen</label>
                        <select class="form-select" required name="departemen">
                            @foreach ($departemen as $item)
                            <option selected value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Email</label>
                        <input type="text" class="form-control " placeholder="" id='email' required name="email"
                            value="{{$data->email}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Password</label>
                        <input type="password" class="form-control " placeholder="" id='email' required name="password"
                            value="{{old('password')}}">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-info float-sm-start col-md-2 mt-4">Save</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
