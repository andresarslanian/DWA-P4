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
	<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info alert-dismissible' role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		{{ Session::get('flash_message') }}
	</div>
	@endif

	@if( Auth::user()->can('create_replacements') )
	{{ Form::open(array('url' => '/create-replacement')) }}
	<div class="col-sm-12 btn-bar">
		<a class="btn btn-info" href="/list-incidents">View All</a>
		{{Form::hidden('incident_id', $incident->id)}}
		<a href="/show-incident/{{$incident->id}}" class="btn btn-info pull-right done-incident-edit">Done</a>
		<button class="btn btn-info pull-right">Create Replacement</button>		
	</div>
	{{ Form::close() }}	
	@endif
	{{ Form::open(array('url' => '/update-incident')) }}
	{{Form::hidden('incident_id', $incident->id)}}
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
					<td > {{ Form::select('state_id', $states, $incident->state->id , array('class' => 'form-control')) }}
					</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Incident:</strong></td>
					<td > {{ Form::select('type_id', $incidents, $incident->type->id , array('class' => 'form-control')) }}
					</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Action:</strong></td>
					<td >
						@if ($incident->action)
						{{ Form::select('action_id', $actions, $incident->action->id , array('class' => 'form-control')) }}						
						@else
						{{ Form::select('action_id', $actions, '' , array('class' => 'form-control')) }}		
						@endif	
					</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Lamp Type:</strong></td>
					<td >
						@if ($incident->lamp_type)
						{{ Form::select('lamp_type_id', $lamp_types, $incident->lamp_type->id , array('class' => 'form-control')) }}						
						@else
						{{ Form::select('lamp_type_id', $lamp_types, '' , array('class' => 'form-control')) }}		
						@endif						
					</td>
				</tr>				
				<tr>
					<td class="col-sm-3" ><strong>HW Address:</strong></td>
					<td >
						{{ Form::text('hw_address', $incident->hw_address, array('class' => 'form-control')) }}
						<div class="validation-message-error">{{$errors->first('hw_address')}}</div>
					</td>
				</tr>
				<tr>
					<td class="col-sm-3" ><strong>Description:</strong></td>
					<td >{{$incident->description}}</td>	
				</tr>																							
			</tbody>
		</table>	
		<div class="col-sm-12 center">
			{{ Form::submit('Save Changes', array('class' => 'btn btn-info ')) }}
		</div>

	</div>
	{{ Form::close() }}	


	@if (isset($replacements[0]) )
	<div class="col-sm-offset-4 col-sm-4 in-re">
		<h3>Replacement</h3>
	</div>	
	@include('replacement/_list')
	@endif

</div>

@stop
