@extends('_master')

@section('title')
View Incident
@stop

@section('content')
	
<div class=" p-body-wrapper col-sm-10 col-sm-offset-1 incident-view-container">
	<div class="col-sm-12 center page-title">
		<h1>Incidents {{$incident->id}}</h1>
	</div>

	@if(Session::get('flash_message'))
	<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info' role="alert">{{ Session::get('flash_message') }}</div>
	@endif


	<div class="col-sm-12 btn-bar">
		<a class="btn btn-info" href="/list-incidents">View All</a>
		@if( Auth::user()->can('modify_incident'))
			<a href="/edit-incident/{{$incident->id}}" class="btn btn-info pull-right">Edit</a>
		@endif		
	</div>

	<div class="col-sm-6 forms-container">
		<table class="col-sm-12 table  table-hover">
			<tbody>
				<tr>
					<td class="col-sm-3" ><strong>Reported By:</strong></td>
					<td >{{ $incident->reporter->company->name }}</td>
				</tr>	
				<tr>
					<td class="col-sm-3" ><strong>Owner:</strong></td>
					<td >{{ $incident->owner->name }}</td>
				</tr>								
				<tr>
					<td class="col-sm-3" ><strong>Address:</strong></td>
					<td >{{$incident->address }}</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>House #:</strong></td>
					<td >{{ $incident->house_number }}</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Picket #:</strong></td>
					<td >{{ $incident->picket_number }}</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Created:</strong></td>
					<td >{{$incident->created_at}}</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Last Updated:</strong></td>
					<td >{{$incident->updated_at}}</td>
				</tr>	
			</tbody>
		</table>
	</div>
	<div class="col-sm-5 col-sm-offset-1 forms-container">
		<table class="col-sm-12 table  table-hover">
			<tbody>
				<tr>
					<td class="col-sm-3" ><strong>State:</strong></td>
					<td >{{$incident->state->description }}</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Incident:</strong></td>
					<td >{{ $incident->type->description }}</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Action:</strong></td>
					<td >
						@if ($incident->action)
						{{$incident->action->description}}
						@else
						-
						@endif	
					</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Lamp Type:</strong></td>
					<td >
						@if ($incident->lamp_type)
						{{$incident->lamp_type->type}}
						@else
						-
						@endif
					</td>
				</tr>					
				<tr>
					<td class="col-sm-3" ><strong>HW Address:</strong></td>
					<td >{{ $incident->hw_address }}</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Description:</strong></td>
					<td >{{$incident->description}}</td>	
				</tr>																							
			</tbody>
		</table>	
	</div>

	@if (isset($replacements[0]) )
	<div class="col-sm-offset-4 col-sm-4 in-re">
		<h3>Replacement</h3>
	</div>	
	@include('replacement/_list')
	@endif

</div>

@stop
