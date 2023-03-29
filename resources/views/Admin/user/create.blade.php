@extends('admin.layouts.main')

@section('isi')

    <div class="container-fluid py-4">
    <div class="row">
        <div class="col-8 m-auto">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-uppercase ps-3">Data {{$title}}</h6>
                    </div>
                    <form method="post" action="/admin/user">
                    @csrf
                    <label class="text-xl text-dark font-weight-bolder">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control " placeholder="Enter your name" name="name">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Email</label>
                    <div class="mb-2">
                        <input type="email" class="form-control" id="email" placeholder="Enter your email address" name="email">
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

                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Save</button>
                    <a href="/admin/user" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</a>
    </form>
                </div>
            </div>
        </div>
    </div>
    </div>




@endsection
