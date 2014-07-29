@extends('_master')

@section('title')
Incidents
@stop

@section('content')

<div class="col-sm-offset-5 col-sm-7">
	<h1>Incidents</h1>
</div>

<div class="col-sm-12 signup-container">
	<a href="/create-incident" class="btn btn-primary col-sm-2">Add new incident</a>
{{ Form::open(array('url' => '/list-users', 'class' => 'form-horizontal','method' => 'POST')) }}
	<div class="form-group  list-filter">
		<div class="col-sm-8">
			{{ Form::select('company', $companies, '', array('class' => 'form-control')) }}
		</div>
		{{ Form::submit('View', array('class' => 'btn btn-primary')) }}
	</div>
{{ Form::close() }}

	<table class="table table-striped table-hover list-table">
		<thead>
			<tr>
		
				<th>id</th>
				<th>Created</th>
				<th>Address</th>
				<th>House #</th>
				<th>Picket #</th>
				<th>Incident</th>
				<th>
					@if ($sort == 'owner_id' && $order == 'asc') 
						{{ link_to_route('incident.list','Owner', array('sort' => 'owner_id', 'order' => 'desc')) }}
	                @else 
	                	{{ link_to_route('incident.list','Owner', array('sort' => 'owner_id', 'order' => 'asc')) }}
	                @endif
				</th>
				<th>State</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($incidents as $incident)
				<tr>
					<td>{{$incident->id}}</td>
					<td>{{$incident->created_at}}</td>
					<td>{{$incident->address}}</td>
					<td>{{$incident->house_number}}</td>
					<td>{{$incident->picket_number}}</td>
					<td>{{$incident->type->description}}</td>
					<td>{{$incident->owner->name}}</td>
					<td>{{$incident->state->description}}</td>

					<td>
						@if ($incident->action)
							{{$incident->action->description}}
						@else
							-
						@endif
					</td>
				</tr>
			@endforeach
	    </tbody>		
	</table>
	<div class="col-sm-8 col-sm-offset-2 center">
		{{$incidents->addQuery('order',$order)->addQuery('sort', $sort)->links()}}
	</div>
	
</div>

@stop
