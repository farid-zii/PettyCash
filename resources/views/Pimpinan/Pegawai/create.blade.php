<div class="modal fade" dty id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Entry Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="/hrd/pegawai" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="modal-body row g-2">
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder" required>Nama</label>
                        <input type="text" class="form-control" placeholder="" name="nama" value="{{old('nama')}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder" required>Username</label>
                        <input type="text" class="form-control" placeholder="" name="username" value="{{old('username')}}">
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
                        <input type="number" class="form-control " placeholder="" id='nip' required name="nip"
                            value="{{old('nip')}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">No Handphone</label>
                        <input type="number" class="form-control " placeholder="" required name="phone"
                            value="{{old('phone')}}">
                    </div>
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Jenis Kelamin</label>
                        <select class="form-select" name="kelamin" required style="">
                            <option selected value="Laki-Laki">Laki-Laki</option>
                            <option  value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="text-xl text-dark font-weight-bolder">Departemen</label>
                        <select class="form-select" required name="departemen">
                            @foreach ($departemen as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Email</label>
                        <input type="text" class="form-control " placeholder="" id='email' required name="email"
                            value="{{old('email')}}">
                    </div>
                    <div class="col-md-12">
                        <label class="text-xl text-dark font-weight-bolder ">Password</label>
                        <input type="password" class="form-control " placeholder="" id='email' required name="password"
                            value="{{old('password')}}">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Entry</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-dark float-sm-end col-md-2 mt-4 me-3">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
