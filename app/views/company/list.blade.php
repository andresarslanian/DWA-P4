@extends('_master')

@section('title')
Companies
@stop

@section('content')

<div class="col-sm-offset-5 col-sm-7">
	<h1>Companies</h1>
</div>

	@if(Session::get('flash_message'))
		<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info alert-dismissible' role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			{{ Session::get('flash_message') }}
		</div>
	@endif	

<div class="col-sm-8 col-sm-offset-2 signup-container">
	@if( Auth::user()->can('create_companies') && Auth::user()->worksFor('Philips') )
		<a href="/create-company" class="btn btn-primary col-sm-2 cr-cmp">Add new company</a>
	@endif
	
	<table class="table table-striped table-hover list-table">
		<thead>
			<tr>
		
				<th>id</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($companies as $company)
				<tr>
					<td>{{$company->id}}</td>
					<td>{{$company->name}}</td>
					<td>{{$company->phone}}</td>
					<td>{{$company->email}}</td>
				</tr>
			@endforeach
	    </tbody>		
	</table>
	<div class="col-sm-8 col-sm-offset-2 center">
		{{$companies->links()}}
	</div>
	
</div>

@stop
