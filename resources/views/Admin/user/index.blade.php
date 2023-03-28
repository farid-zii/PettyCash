@extends('admin.layouts.main')

@section('isi')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-uppercase ps-3">Data {{$title}}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" style="width: 50%;margin:0 auto;"
                        role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session()->has('pesan'))
                    <div class="alert alert-success text-light" role="alert">
                        <strong>
                            {{ session ('pesan') }}
                        </strong>
                    </div>
                    @endif

                    <div class="mx-3">
                        <button class="btn bg-gradient-danger w-15 my-4 mb-2">Cetak Pdf</button>
                        <button class="btn bg-gradient-success w-15 my-4 mb-2">Cetak Excel</button>
                        <button class="btn bg-gradient-info w-15 my-4 mb-2 float-sm-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Entry</button>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr class="bg-dark">
                                    <th
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        No</th>
                                    <th style="width: 15%"
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Nama</th>
                                    <th
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7 ps-2">
                                        Level</th>
                                    <th
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Dibuat</th>
                                    <th style="width: 18%"
                                        class="text-center text-uppercase text-light text-xs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($user as $data )
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="" style="width: 15%">
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                    class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0 text-sm">{{$data->name}}</h6>
                                                <p class="text-xs text-secondary mb-0">{{$data->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ Str::upper($data->level)}}</p>
                                        <p class="text-xs text-secondary mb-0">Organization</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{$data->created_at->diffforHumans()}}</span>
                                    </td>
                                    <td class="bg-info text-center">
                                        <div class="d-flex">
                                            <a href="javascript:;" class="btn btn-light font-weight-bold m-auto"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                            <form action="/admin/user/{{$data->id}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-warning font-weight-bold m-auto" type="submit" onclick="return confirm('Yakin akan menghapus data ?')">Delete</button>
                                            </form>
                                        </div>
                                        {{-- <a href="javascript:;" class="btn btn-warning font-weight-bold"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Delete
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CREATE -->
<div class="modal fade" dty id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/admin/user">
                <div class="modal-body">
                    @csrf
                    <label class="text-xl text-dark font-weight-bolder">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="Enter your name" name="name">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Email</label>
                    <div class="mb-2">
                        <input type="email" class="form-control" placeholder="Enter your email address" name="email">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Level</label>
                    <div class="mb-2">
                        <select class="form-select" aria-label="Default select example" name='level'>
                            <option value="admin">ADMIN</option>
                            <option value="hrd">HRD</option>
                            <option value="finance">FINANCE</option>
                            <option value="direktur">DIREKTUR</option>
                        </select>
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Passowrd</label>
                    <div class="mb-2">
                        <input type="password" class="form-control" placeholder="*******" name="password">
                    </div>

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Save</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT --}}


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>



<script>
    let nama = $('#nama').value;
    var i = 0;
    $('#add').click(function () {
        ++i;
        $('#table').append(
            `<tr>
            <td><input type="text" class="form-control" name="inputs[+i+][nama]" placeholder=""></td>
            <td><input type="text" class="form-control" name="inputs[+i+][email]" placeholder=""></td>
            <td><input type="text" class="form-control" name="inputs[+i+][nilai]" placeholder=""></td>
            <td><button type="button" class="btn btn-danger remove-table-row">Hapus</button></td>
            </tr>`
        );
    });

    $(document).on('click', '.remove-table-row', function () {
        $(this).parents('tr').remove();
    });

</script>

@endsection
