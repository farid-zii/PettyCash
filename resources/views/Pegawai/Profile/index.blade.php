@extends('pegawai.layouts.main')

@section('isi')
    <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-success shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-uppercase ps-3">Profle</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    @include('admin.notif')

                    <div class="mx-5" style="display: grid;grid-template-columns: repeat(2,1fr);grid-column-gap: 10%">
                        <div class="my-3 text-center">
                            {{-- <h1>halo {{auth()->user()->name}}</h1> --}}
                            <img src="https://images.glints.com/unsafe/glints-dashboard.s3.amazonaws.com/company-banner-pic/16e4d6351c7f12f357daab99625b1457.jpg" style="width: 100%;border-radius: 10px;box-shadow:3px 3px 2px 1px black;">
                        </div>
                        <form class="my-3" method="put" action="/hrd/profile">
                            @csrf
                            <h4>SETTING</h4>

                            <div class="mb-2 col-12">
                                <label class="text-xl text-dark font-weight-bolder">Nama</label>
                                <input type="text" class="form-control" required name="nama" id="nama" value="{{auth()->user()->nama}}">
                                <input type="hidden" class="form-control" required name="id" id='userId' value="{{auth()->user()->id}}">
                            </div>
                            <div class="mb-2 col-12">
                                <label class="text-xl text-dark font-weight-bolder">NIP</label>
                                <input type="text" name="nip" class="form-control" id="" value="{{auth()->user()->nip}}">
                            </div>
                            <div class="mb-2 col-12">
                                <label class="text-xl text-dark font-weight-bolder">Email</label>
                                <input type="email" name="email" class="form-control" id="" value="{{auth()->user()->email}}">
                            </div>
                            <div class="mb-2 col-12">
                                <label class="text-xl text-dark font-weight-bolder">No. Handphone</label>
                                <input type="number" name="phone" class="form-control" id="" value="{{auth()->user()->phone}}">
                            </div>
                            <label class="text-xl text-dark font-weight-bolder">Password</label>
                            <div class="mb-2">
                                {{-- <input type="password" name="password" class="form-control" id="password1"> --}}
                                <input type="password" name="password" class="form-control" id="password1">
                            </div>
                            <label class="text-xl text-dark font-weight-bolder">Konfirmasi PAssword</label>
                            <div class="mb-2">
                                <input type="password" name="password2" class="form-control" id="password2">
                                <span id="passwordMessage"></span>
                            </div>

                        <div class="footer px-4 mb-2">
                            <button type="submit" onclick="" class="btn btn-warning float-sm-start col-md-2 mt-4">Edit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#password2').on('input', function() {
            var password1 = $('#password1').val();
            var password2 = $(this).val();
            var passwordMessage = $("#passwordMessage");

                if (password2 === "") {
                passwordMessage.hide(); // Sembunyikan pesan jika password kedua kosong
                } else {
                passwordMessage.show(); // Tampilkan pesan jika password kedua tidak kosong
                if (password1 === password2) {
                    passwordMessage.text("Password cocok");
                    passwordMessage.css("color", "white");
                    passwordMessage.css("background", "green");
                    passwordMessage.css("padding", "2px");
                } else {
                    passwordMessage.text("Password tidak cocok");
                    passwordMessage.css({color:"black",background: "red",padding: "3px"});
                }
                }

        });
    });
    function edit() {
        let id = $('#userId').val()
        let nama = $('#nama').val()
        let password1 = $('#password1').val()
        let password2 = $('#password2').val()

        if(password1==password2){
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken
            axios.put(`api/profile/${id}`,{
                // id:id,
                nama:nama,
                password:password1,
            }).then(()=>{
                Swal.fire({
                    title: 'Success',
                    text: 'Berhasil Edit',
                    icon: 'success',
                    timer: 2000,
                    confirmButtonText: 'Close'
                })
            })
        }
        else{
            Swal.fire({
                title: 'Error!',
                text: 'Password Tidak Sama',
                icon: 'error',
                timer: 2000,
                confirmButtonText: 'Close'
            })
        }
    }
</script>


@endsection


