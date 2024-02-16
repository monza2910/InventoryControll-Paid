@extends('layouts.main')

@section('content')

    <div class="d-flex justify-content-center my-4">
        <h1>Selamat Datang Kembali, {{Auth()->user()->name}}</h1>
    </div>
    <div class="d-flex justify-content-center">
        <img src="{{asset('assets/logo/BRILOGO.png')}}" style="height: 40%;width:40%;opacity:0.9" alt="">
    </div>
@endsection