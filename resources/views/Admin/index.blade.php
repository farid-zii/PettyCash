@extends('admin.layouts.main')

@section('isi')
    <h1>
        HALAMAN Admin
    </h1>

    <br>
    <h4>halo {{auth()->user()->name}}</h4>
@endsection
