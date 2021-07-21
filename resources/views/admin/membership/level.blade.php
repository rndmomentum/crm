@extends('layouts.app')

@section('title')
Membership
@endsection

<style>
  .card {
    overflow: hidden;
  }

  .card-block .rotate {
    z-index: 8;
    float: right;
    height: 100%;
  }

  .card-block .rotate i {
    color: rgba(20, 20, 20, 0.15);
    position: absolute;
    left: 0;
    left: auto;
    right: -10px;
    bottom: 0;
    display: block;
    -webkit-transform: rotate(-44deg);
    -moz-transform: rotate(-44deg);
    -o-transform: rotate(-44deg);
    -ms-transform: rotate(-44deg);
    transform: rotate(-44deg);
  }

  
</style>

@include('layouts.navbar')
@section('content')
<div class="col-md-12 pt-3">     
  <div class="card-header" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/membership"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/dashboard">Dashboard</a>  / <a href="/membership">Membership</a> / <b>{{ $membership->name }}</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ $membership->name }}</h1>

      <a class="btn btn-outline-warning" href="{{ url('export-members') }}/{{ $membership->membership_id }}"><i class="bi bi-download pr-2"></i> Export Customer</a>
  </div>

  <div class="row">
    <div class="col-md-9 ">            
      
      @if ($message = Session::get('export-members'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-bs-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      @endif
                
      <!-- Show package in table ----------------------------------------------->
      @if(count($membership_level) > 0)
      <div class="table-responsive">
        <table class="table table-hover" id="successTable">
            <thead>
            <tr class="header">
                <th>#</th>
                <th>Level</th>
                <th class="text-center"><i class="fas fa-cogs"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($membership_level as $key => $membership_levels)    
            <tr>
              <td>{{ $membership_level->firstItem() + $key }}</td>
              <td>{{ $membership_levels->name  }}</td>
              <td class="text-center">
                <a class="btn btn-dark" href="{{ url('membership/level') }}/{{ $membership->membership_id }}/{{ $membership_levels->level_id }}"><i class="bi bi-chevron-right"></i></a>
              </td>
            </tr>
            @endforeach
            </tbody>
        </table>  
      </div>
      @else
      <p>There are no package yet.</p>
      @endif
      <div class="float-right pt-3">{{$membership_level->links()}}</div>
      
    </div>
    
      
    <div class="col-md-3">

      <div class="card bg-light py-4 mb-4 text-center shadow">
        <div class="card-block text-dark">
          <div class="rotate">
          <i class="fas fa-file-invoice-dollar fa-6x" style="color:rgba(0, 229, 255, 0.3)"></i>
          </div>
          <h3 class="pt-3 pl-3">{{$total}}</h3>
          <h6 class="lead pb-2 pl-3">Total {{ $membership->name }}</h6>
        </div>
      </div>
              
    </div>
    
  </div>
        
</div>


<!-- Enable function for search payment ------------------------------------->
<script>
  function successFunction() 
  {
    var input, filter, table, tr, td, i, txtValue;

    input = document.getElementById("successInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("successTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) 
    {
      td = tr[i].getElementsByTagName("td")[1];
      
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
</script>

@endsection
