@extends('layouts.temp')

@section('title')
{{ $package->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 px-2 py-5 text-center">
        <img src="/assets/images/logo.png" style="max-width:200px">
        <h1 class="display-4 text-dark px-4 pt-3">{{ $product->name }}</h1>
    </div>
    
    <div class="col-md-6 offset-md-3">
        <div class="card px-4 py-4 shadow">
            <p class="lead px-3">No. Kad Pengenalan / Passport</p>
            <form action="{{ url('verification') }}/{{ $product->product_id }}/{{ $package->package_id }}" method="get">
                @csrf
                <div class="col-md-12 pb-3">
                    <input type="text" class="form-control" name="ic" placeholder="tanpa '-' .Cth: 91042409**** / A********" maxlength="12" required="" >
                </div>
                <div class="col-md-12 pb-3">
                    <button type="submit" class="text-white btn btn-block" style="background-color: #202020">Seterusnya &nbsp;<i class="fas fa-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 text-center pt-3">
        <a href="https://momentuminternet.com/privacy-policy/">Privacy & Policy</a>
    </div>
</div>

<footer class="text-center px-4 py-5">
    <b>Momentum Internet (1079998-A) © 2020 All Rights Reserved​</b>
</footer>

@endsection