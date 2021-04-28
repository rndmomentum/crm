@extends('layouts.temp')

@section('title')
Upgrade Pakej
@endsection

{{-- Custom button css ----------------------------}}
<style>
    .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 32px 16px;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 5px;
    transition-duration: 0.4s;
    cursor: pointer;
    }
    .button4 {
    background-color: #f3f3f3;
    color: #202020;
    border: 1px #e7e7e7 solid;
    width: 250px;
    }

    .button4:hover {background-color: #e7e7e7;}
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 px-3 pt-5 pb-3 text-center border-bottom">
            <img src="/assets/images/logo.png" style="max-width:150px">
            <h1 class="text-dark px-4 pt-3">{{ $product->name }}</h1>
        </div>

        <div class="col-md-12 py-3">
            <form action="" method="POST">
                @csrf
  
                {{-- <div class="w-50 px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center">
                    <h1 class="font-weight-bold">{{ $product->name }}</h1>
                    <p class="lead">Hai! Sila buat pilihan di bawah untuk upgrade pakej.</p>
                </div> --}}
                <div class="container text-center">
                    <div class="row">
                        <div class="col-auto pb-4 d-block mx-auto">
                            <div class="pricing-item bg-white py-4" style=" box-shadow: 0px 0px 30px -7px rgba(0,0,0,0.29); border-radius: 5px;">
                                <div class="pb-2" style="letter-spacing: 2px">
                                    <h4>{{ $current_package->name }}</h4>
                                </div>
                                <div class="py-2">
                                    <span id="price"></span>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 px-5">
                                        <button type="submit" class="button button4" name="pay_method" value="{{ $stripe ?? '' }}">
                                            <i class="far fa-credit-card fa-3x"></i>
                                            <br>Kad Debit/Kredit
                                        </button>
                                    
                                        <button type="submit" class="button button4" name="pay_method" value="{{ $billplz ?? '' }}">
                                            <i class="fas fa-university fa-3x"></i>
                                            <br>FPX
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    
            </form>
        </div>
    </div>
</div>



<script>
    var x = '{{ $current_package->price }}';
    var y = 4;
    var z = x - y;
    document.getElementById("price").innerHTML = z;
    console.log(x);
</script>
@endsection