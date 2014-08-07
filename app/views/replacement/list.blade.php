@extends('_master')

@section('title')
Replacements
@stop

@section('content')


<div class="p-body-wrapper col-sm-10 col-sm-offset-1">
	<div class="col-sm-12 center page-title">
		<h1>Replacements</h1>
	</div>

	@if(Session::get('flash_message'))
	<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info alert-dismissible' role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		{{ Session::get('flash_message') }}
	</div>
	@endif

	@if( Auth::user()->worksFor('Philips') )
	{{ Form::open(array('url' => '/list-replacements', 'class' => 'form-horizontal','method' => 'POST')) }}
	<div class="form-group  list-filter">
		<div class="col-sm-8">
			{{ Form::select('company', $companies, '', array('class' => 'form-control')) }}
		</div>
		{{ Form::submit('View', array('class' => 'btn btn-primary')) }}
	</div>
	{{ Form::close() }}
	@endif

	<table class="table table-striped table-hover list-table">
		<thead>
			<tr>
				<th>id</th>
				<th>Created</th>
				<th>Updated</th>
				<th>Company</th>
				<th>Incident #</th>
				<th>Lamp Type</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($replacements as $replacement)
			<tr>
				<td>{{$replacement->id}}</td>
				<td>{{$replacement->created_at}}</td>
				<td>{{$replacement->updated_at}}</td>
				<td>{{$replacement->user->company->name}}</td>
				<td>{{ link_to_route('incident.show',$replacement->incident_id, array('id' => "$replacement->incident_id")) }}</td>	
				<td>
					@if ($replacement->lamp)
					{{$replacement->lamp->type->description}}
					@else
					-
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>		
	</table>
	<div class="col-sm-8 col-sm-offset-2 center">
		{{$replacements->addQuery('order',$order)->addQuery('sort', $sort)->links()}}
	</div>
	
</div>

@stop
