@extends('layouts.app')

@section('title')
    Sales Tracking
@endsection

@include('layouts.navbar')
@section('content')
<div class="col-md-12 pt-2">     
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
      <a href="/trackprogram"><i class="fas fa-arrow-left"></i></a> &nbsp; <a href="/dashboard">Dashboard</a> / <a href="/trackprogram">Customer</a> / <b>{{ $product->name }}</b>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $product->name }}</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group">
            <a class="btn btn-sm btn-outline-warning" href="{{ url('exportProgram') }}/{{ $product->product_id }}"><i class="fas fa-download pt-1 pr-1"></i> Export Buyer</a>
            <a class="btn btn-sm btn-outline-warning" href="{{ url('export-participant') }}/{{ $product->product_id }}"><i class="fas fa-download pt-1 pr-1"></i> Export Participant</a>
          </div>
        </div>
    </div>        

    @if ($message = Session::get('export-buyer'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('export-participant'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <div class="row">
      <div class="col-md-12 "> 
        
        <!-- Show data in cards --------------------------------------------------->
        <div class="row mb-3">
          <div class="col-xl-3 col-lg-6 py-2">
            <div class="card border-0 gradient-1 shadow text-center">
              <h6 class="pt-3">Paid Ticket</h6>
              <b class="display-6 pb-3">{{ number_format($totalsuccess) }}</b>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 py-2">
            <div class="card border-0 gradient-2 shadow text-center">
              <h6 class="pt-3">Free Ticket</h6>
              <b class="display-6 pb-3">{{ number_format($freeticket) }}</b>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 py-2">
            <div class="card border-0 gradient-3 shadow text-center">
              <h6 class="pt-3">Updated Ticket</h6>
              <b class="display-6 pb-3">{{ number_format($paidticket) }}</b>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 py-2">
            <div class="card border-0 gradient-4 shadow text-center">
              <h6 class="pt-3">Pending Payment</h6>
              <b class="display-6 pb-3">{{ number_format($totalcancel) }}</b>
            </div>
          </div>
        </div>


        <!-- Show package in table ----------------------------------------------->
        @if(count($package) > 0)
        <table class="table table-hover" id="successTable">
            <thead>
            <tr class="header">
                <th>#</th>
                <th>Package Name</th>
                <th class="w-25"><i class="fas fa-cogs"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($package as $key => $packages)    
            @if ($product->product_id == $packages->product_id)   
            <tr>
              <td>{{ $package->firstItem() + $key }}</td>
              <td>{{ $packages->name  }}</td>
              <td>
                <a class="btn btn-sm btn-dark" href="{{ url('view/buyer') }}/{{ $product->product_id }}/{{ $packages->package_id }}"><i class="fas fa-user pr-1"></i> Buyer</a>                    
                <a class="btn btn-sm btn-dark" href="{{ url('view/participant') }}/{{ $product->product_id }}/{{ $packages->package_id }}"><i class="fas fa-users pr-1"></i> Participant</a>
              </td>
            </tr>
            @endif
            @endforeach
            </tbody>
        </table>  
        @else
        <p>There are no package yet.</p>
        @endif
        <div class="float-right pt-3">{{$package->links()}}</div>
        
      </div>
    </div>
  </div>
</div>

@endsection
