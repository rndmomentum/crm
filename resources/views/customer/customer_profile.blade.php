@extends('layouts.app')

@section('title')
Customer Profiles
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

  body{margin-top:20px;}
.timeline {
    border-left: 3px solid #727cf5;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    background: rgba(114, 124, 245, 0.09);
    margin: 0 auto;
    letter-spacing: 0.2px;
    position: relative;
    line-height: 1.4em;
    font-size: 1.03em;
    padding: 50px;
    list-style: none;
    text-align: left;
    max-width: 40%;
}

@media (max-width: 767px) {
    .timeline {
        max-width: 98%;
        padding: 25px;
    }
}

.timeline h1 {
    font-weight: 300;
    font-size: 1.4em;
}

.timeline h2,
.timeline h3 {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 10px;
}

.timeline .event {
    border-bottom: 1px dashed #e8ebf1;
    padding-bottom: 25px;
    margin-bottom: 25px;
    position: relative;
}

@media (max-width: 767px) {
    .timeline .event {
        padding-top: 30px;
    }
}

.timeline .event:last-of-type {
    padding-bottom: 0;
    margin-bottom: 0;
    border: none;
}

.timeline .event:before,
.timeline .event:after {
    position: absolute;
    display: block;
    top: 0;
}

.timeline .event:before {
    left: -207px;
    content: attr(data-date);
    text-align: right;
    font-weight: 100;
    font-size: 0.9em;
    min-width: 120px;
}

@media (max-width: 767px) {
    .timeline .event:before {
        left: 0px;
        text-align: left;
    }
}

.timeline .event:after {
    -webkit-box-shadow: 0 0 0 3px #727cf5;
    box-shadow: 0 0 0 3px #727cf5;
    left: -55.8px;
    background: #fff;
    border-radius: 50%;
    height: 9px;
    width: 9px;
    content: "";
    top: 5px;
}

@media (max-width: 767px) {
    .timeline .event:after {
        left: -31.8px;
    }
}

.rtl .timeline {
    border-left: 0;
    text-align: right;
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    border-right: 3px solid #727cf5;
}

.rtl .timeline .event::before {
    left: 0;
    right: -170px;
}

.rtl .timeline .event::after {
    left: 0;
    right: -55.8px;
}

.pre-scrollable {
    max-height: 100px;
    overflow-y: scroll;
}
</style>

@section('content')
    <div class="col-md-12 pt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('customer_profiles') }}">Customer Profiles</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Customer Information</h1>
        </div> 


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 pt-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>Personal Details</strong>
                        </div>
            
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="First Name">First Name</label>
                                        <input type="text" class="form-control" value="{{ $customer->first_name }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="First Name">Last Name</label>
                                        <input type="text" class="form-control" value="{{ $customer->last_name }}" disabled>
                                    </div>
                                </div>
            
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="IC Number">IC Number</label>
                                        <input type="text" class="form-control" value="{{ $customer->ic }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="First Name">Email Address</label>
                                        <input type="text" class="form-control" value="{{ $customer->email }}" disabled>
                                    </div>
                                </div>
            
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Phone Number">Phone Number</label>
                                        <input type="text" class="form-control" value="{{ $customer->phoneno }}" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-6 pt-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>Payment Details</strong>
                        </div>
            
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="First Name">Package Name</label>
                                        <input type="text" class="form-control" value="{{ $package->name }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="First Name">Quantity</label>
                                        <input type="text" class="form-control" value="{{ $payment->quantity }}" disabled>
                                    </div>
                                </div>
            
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="IC Number">Offer ID</label>
                                        @if (is_null($payment->offer_id))
                                            <input type="text" class="form-control" value="---" disabled>
                                        @else
                                            <input type="text" class="form-control" value="{{ $payment->offer_id }}" disabled>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="First Name">Date Purchase</label>
                                        <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($payment->created_at)) }}" disabled>
                                    </div>
                                </div>
            
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Phone Number">Payment</label>
                                        <input type="text" class="form-control" value="RM {{ $payment->totalprice }}.00" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Phone Number">Payment Status</label>
                                        @if (is_null($payment->status))
                                            <input type="text" class="form-control" value="NULL" disabled>
                                        @else
                                            <input type="text" class="form-control" value="{{$payment->status}}" disabled>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            {{-- Timeline --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Timeline</strong></h6>
                                    <div id="content" class="overflow-auto" style="max-height: 450px;">
                                        <ul class="timeline">
                                            @foreach ($data as $key => $d)
                                                <li class="event" data-date="{{ $d->date_from }}">
                                                    <h3>{{ $d->name }}</h3>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection