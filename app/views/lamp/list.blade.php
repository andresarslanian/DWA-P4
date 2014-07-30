@extends('_master')

@section('title')
Lamps
@stop

@section('content')

<div class="col-sm-offset-5 col-sm-7">
	<h1>Lamps</h1>
</div>

<div class="col-sm-10 col-sm-offset-1 lamp-container">

	{{ Form::open(array('url' => '/list-lamps', 'class' => 'form-horizontal','method' => 'POST')) }}
	<div class="form-group  col-sm-4 pull-right lamp-filters">
		<div class="col-sm-8">
			{{ Form::select('state', $states, '', array('class' => 'form-control')) }}
		</div>
		<div class="col-sm-8">
			{{ Form::select('type', $types, '', array('class' => 'form-control')) }}
		</div>
		{{ Form::submit('View', array('class' => 'btn btn-primary')) }}
	</div>
	{{ Form::close() }}

	<table class="table table-striped table-hover list-table">
		<thead>
			<tr>
				<th>id</th>
				<th>
					@if ($sort == 'created_at' && $order == 'asc') 
					{{ link_to_route('lamp.list','Created', array('sort' => 'created_at', 'order' => 'desc')) }}
					@else 
					{{ link_to_route('lamp.list','Created', array('sort' => 'created_at', 'order' => 'asc')) }}
					@endif
				</th>
				<th>Serial</th>
				<th>Type</th>
				<th>State</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($lamps as $lamp)
			<tr>
				<td>{{$lamp->id}}</td>
				<td>{{$lamp->created_at}}</td>
				<td>{{$lamp->serial}}</td>
				<td>{{$lamp->type->description}}</td>
				<td>{{$lamp->state->description}}</td>
				<td>{{$lamp->description}}</td>
			</tr>
			@endforeach
		</tbody>		
	</table>
	<div class="col-sm-8 col-sm-offset-2 center">
		{{$lamps->addQuery('order',$order)->addQuery('sort', $sort)->links()}}
	</div>
	
</div>

@stop
