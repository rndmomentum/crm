@extends('layouts.app')

@section('title')
  SMS Bulk
@endsection

@section('content')
<div class="row px-4 py-4">
	<div class="col-md-12">
		<div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
			<a href="/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; 
			<a href="/dashboard">Dashboard</a> / 
			<b>SMS Bulk</b>
		</div> 

		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">SMS Bulk</h1>
			
			<div class="btn-toolbar mb-2 mb-md-0">
				<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#new-bulk-sms">
					<i class="bi bi-plus-lg pr-2"></i> New Bulk SMS
				</button>&nbsp;
				
				<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#new-sms">
					<i class="bi bi-plus-lg pr-2"></i> New SMS
				</button>
			</div>
		</div>
		
		<input type="text" class="form-control" placeholder="Please Enter Event Name" title="Type in a name">
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
		
		<!-- View event details in table ----------------------------------------->
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Phone</th>
						<th>Title</th>
					</tr>
				</thead>
				
				<tbody>
				@php
				$no = 1;
				@endphp
				@foreach ($x as $k => $t)
					<tr>
						<td>{{ $no++ }}</td>
						
						<td>{{ $t->created_at }}</td>
						
						<td>
							{{ $t->phone }}
						</td>
						
						<td>
							{{ $t->title }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>   
		</div> 
	</div>
</div>

<div class="modal fade" id="new-sms">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-bottom-0">
				<h5 class="modal-title">Send New SMS</h5>
				
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form action="{{ url('smsblast/send') }}" method="POST"> 
					@csrf
					Template:
					<select class="form-control" name="template">
					@foreach ($y as $k => $t)
						<option value="{{ $t->id }}">{{ $t->title }}</option>
					@endforeach
					</select><br />
					
					Phone Number:
					<textarea class="form-control" name="phone" placeholder="seperated by comma ','"></textarea><br />
					
					<div class='col-md-12 text-right px-4'>
						<button type='submit' class='btn btn-success'> 
							<i class="fas fa-save pr-1"></i> Save 
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="new-bulk-sms">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-bottom-0">
				<h5 class="modal-title">Send New Bulk SMS</h5>
				
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form action="{{ url('smsblast/send_bulk') }}" method="POST" enctype="multipart/form-data"> 
					@csrf
					Template:
					<select class="form-control" name="template">
					@foreach ($y as $k => $t)
						<option value="{{ $t->id }}">{{ $t->title }}</option>
					@endforeach
					</select><br />
					
					Excel Phone:
					<input type="file" /><br />
					
					<div class='col-md-12 text-right px-4'>
						<button type='submit' class='btn btn-success'> 
							<i class="fas fa-save pr-1"></i> Save 
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection




























