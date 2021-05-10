@extends('layouts.app')

@section('title')
  Terima Kasih
@endsection

<style>
  body {
    background-color:rgb(233, 233, 233)!important ; 
  }

</style>

@section('content')
<div class="row">
  <div class="col-md-12 px-5 py-4">
    <div class="text-center">
        <h3 class="display-4">Terima Kasih!</h3>
        <h3 class="display-4">Maklumat telah berjaya dikemaskini.</h3>
        <div class="py-3" style="font-size: 24px; color: green;">
          <i class="far fa-check-circle fa-8x text-center"></i>
        </div>
        <hr>
        <p class="lead">Pengesahan pengemaskinian akan dihantar kepada emel yang telah didaftarkan dalam masa 48 Jam. Terima kasih kerana menunggu.</p>
        <p class="lead">Jika terdapat sebarang pertanyaan, sila <a href="https://momentuminternet.com/contactus/" class="link-primary">hubungi kami.</a></p>
    </div>
  </div>
</div>
@endsection