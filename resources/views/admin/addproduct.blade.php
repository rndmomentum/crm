@extends('layouts.app')

@section('title')
    Event
@endsection


@section('content')

<!-- Jquery (For Date) --------------------------------------------------->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/humanity/jquery-ui.css"> 

<div class="col-md-12 pt-3">
        
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="/product"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <a href="/product">Event</a> / <b>Create Event</b>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Event</h1>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <!-- Add product form --------------------------------------------------->
    <form class="row g-3 px-3" action="{{ url('new-product/save') }}" method="POST" enctype="multipart/form-data"> 
    @csrf

        <div class="col-md-6">
            <label class="form-label">Event Name</label>
            <input name="prodname" type="text" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Offer Provided</label>
            <select class="form-select" aria-label="Default select example" name="offer_id" required>
                <option disabled selected>-- Please Select One --</option>
                @foreach($offers as $offer)
                <option value="{{ $offer->offer_id }}">{{ $offer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Date From</label>
            <input type="text" name="date1" id="date1" class="form-control" placeholder="Date From" required/>
        </div>
        <div class="col-md-6">
            <label for="inputAddress2" class="form-label">Date To</label>
            <input type="text" name="date2" id="date2" class="form-control" placeholder="Date To" required/>
        </div>

        <div class="col-md-6">
            <label class="form-label">Time From</label>
            <input type="time" name="time1" class="form-control" required/>
        </div>
        <div class="col-md-6">
            <label class="form-label">Time To</label>
            <input type="time" name="time2" class="form-control" required/>
        </div>

        <div class="col-md-5">
            <label class="form-label">Certificate Image</label>
            <input class="form-control" type="file" id="formFile" name="cert_image">
            <em>*Please ignore this part if there is no certificate provided for the event</em>
        </div>

        <div class="col-md-3">
            <label class="form-label">Survey Form Link</label>
            <input name="survey_form" type="text" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label">BillPlz Collection ID</label>
            <select class="form-select" name="collection_id" required>
                <option disabled selected>-- Please select --</option>
                <option value="dlzmocfv">dlzmocfv</option>
                <option value="7gxypqhq">7gxypqhq</option>
            </select>
        </div>
        <em>RPM = <b>dlzmocfv</b>; ARB = <b>7gxypqhq;</b></em>

        <div class="col-md-2">
            <label class="form-label">Dashboard Report</label>
            <select class="form-select" name="status" required>
                <option disabled selected>-- Please select --</option>
                <option value="active">Active</option>
                <option value="deactive">Deactive</option>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary float-right"><i class="bi bi-save pr-2"></i>Submit</button>
        </div>

    </form>

</div>

<!-- Function for datepicker --------------------------------------------------->
<script>
    $(document).ready(function () {

        $("#date1").datepicker({
            showAnim: 'drop',
            numberOfMonth: 1,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $("#date2").datepicker("option", "minDate", selectedDate);
            }
        });

        $("#date2").datepicker({
            showAnim: 'drop',
            numberOfMonth: 1,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $("#date1").datepicker("option", "maxDate", selectedDate);
            }
        });

    });
</script>
  
@endsection

