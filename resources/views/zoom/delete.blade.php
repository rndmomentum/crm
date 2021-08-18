@extends('layouts.app')

@section('title')
  Delete Zoom Webinar
@endsection

@section('content')
<div class="row px-4 py-4">
	<div class="col-md-12">
		<div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
			<a href="/zoom"><i class="bi bi-arrow-left"></i></a> &nbsp; 
			<a href="/dashboard">Dashboard</a> / 
			<a href="/zoom">Zoom Webinar</a> / 
			<b>Delete Zoom Webinar</b>
		</div> 

		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Delete Zoom Webinar</h1>
		</div>
		
		
		<br>
			
		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-bs-dismiss="alert">×</button>	
			<strong>{{ $message }}</strong>
		</div>
		@endif
		
		@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-bs-dismiss="alert">×</button>	
			<strong>{{ $message }}</strong>
		</div>
		@endif
		
		@if($zoom->count() > 0)
		<form action="{{ url('zoom/delete') }}/{{ $zoom->id }}" method="POST">
			{{ method_field('DELETE') }}
			
			@csrf
			
			<div class='col-md-12'>
				By clicking below button will remove Zoom Webinar titled <strong>{{ $zoom->topic }}</strong> permanently.<br /><br />
				<button type='submit' class='btn btn-danger'> 
					<i class="fas fa-trash pr-1"></i> Permanent Delete 
				</button>
			</div>
			
			
		</form>
		@else
			<div class="alert alert-danger alert-block">
				<strong>Selected data is not availble in database. Please select a correct data.</strong>
			</div>
		@endif
	</div>
</div>

@endsection




























