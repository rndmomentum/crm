@extends('layouts.app')

@section('title')
    Dashboard
@endsection


@section('content')
<style>
html, body {
	height: 100%;
}

.issue-card {
	height: calc(100% - 100px);
}

.container-fluid {
	height: calc(100% - 50px);
}

.h-100{
	height: 100%;
}

.h-m-100 {
	height: calc(100% - 95px)
}

.subject-row {
	padding: 10px;
	border-bottom: 1px solid #e0e0e0;
	cursor: pointer;
}

.subject-row.active {
	background-color: #c7c7c7;
}

.subject-row:hover {
	background-color: #e0e0e0;
	
}
</style>
<div class="row h-100">
	<div class="col-md-12 h-100">     
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Customer Support</h1>
			<p class="lead">Chat base customer support</p>
		</div>
		
		@if ($maintenance)
			<div class="alert alert-danger alert-block">	
				<strong>This page is currently closed for while due to constrcution in progress.</strong>
			</div>
		@else
		
		<div class="row h-m-100">
			<div class="col-md-4 h-100">
				<div class="card h-100">
					<div class="card-header">
						<span class="fas fa-list"></span> Issues Listing
					</div>
					
					<div class="card-body p-0" id="subject-list">
						<div class="subject-row" data-id="">
							<strong><u>Subject</u></strong><br />
							Name<br />
							Email
						</div>
						
						<div class="subject-row active">
							<strong><u>Subject</u></strong><br />
							Name<br />
							Email
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-8 h-100">
				<div class="card h-100" id="chat-container">
					<div class="card-header">
						<div class="row">
							<div class="col-md-6">
								Username
							</div>
							
							<div class="col-md-6 text-right">
								<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#mention-modal">
									Mention <span class="fas fa-at"></span>
								</button>
								
								<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-close-case">
									Close Case <span class="fas fa-book"></span>
								</button>
								
								<button class="btn btn-danger btn-sm" id="close-chat">
									Close <span class="fas fa-times"></span>
								</button>
							</div>
						</div>
						
					</div>
					
					<div class="card-body">
						
					</div>
					
					<div class="card-footer">
						<div class="row">
							<div class="col-md-10 col-sm-8">
								<input type="text" autofocus="on" class="form-control" placeholder="Reply..." id="chat-content" />
							</div>
							
							<div class="col-md-2 col-sm-4">
								<button class="btn btn-primary btn-block" id="chat-send">
									Send <span class="fas fa-paper-plane"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>

<script>
var ws = null;

$(document).ready(function(){
	console.log("JQuery is ready now!");
	
	load_list();
});

$(document).on("click", ".subject-row", function(){
	$("#chat-container").show();
});

$(document).on("click", "#close-chat", function(){
	$("#chat-container").hide();
});

$("#chat-send").on("click", function(){
	//
	//
	//
	$("#chat-content").val("");
});

function load_list(){
	$.ajax({
		method: "POST",
		url: "{{ url('ajax') }}",
		data: {
			action: "list_topic",
			_token: "{{ csrf_token() }}"	
		},
		dataType: "json"
	}).done(function(res){
		if(res.status == "success"){
			var data = res.data;
			
			data.forEach(function(d){
				
			});
		}else{
			alert("Fail fetching listing data from API server.");
		}
	});
}

function run_ws_client(){
	ws = new WebSocket("ws://{{ env('CS_WS_Server') }}/admin/");
}
</script>

@endsection














