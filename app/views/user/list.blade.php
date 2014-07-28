@extends('_master')

@section('title')
Users
@stop

@section('content')

<div class="col-sm-offset-5 col-sm-7">
	<h1>Users</h1>
</div>

<div class="col-sm-8 col-sm-offset-2 signup-container">
	<a href="/create-user" class="btn btn-primary col-sm-2">Add new user</a>
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
				<th>First Name</th>
				<th>Last Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th>
					@if ($sort == 'company_id' && $order == 'asc') 
						{{ link_to_route('user.list','Company', array('sort' => 'company_id', 'order' => 'desc')) }}
	                @else 
	                	{{ link_to_route('user.list','Company', array('sort' => 'company_id', 'order' => 'asc')) }}
	                @endif
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->firstname}}</td>
					<td>{{$user->lastname}}</td>
					<td>{{$user->phone}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->company->name}}</td>
				</tr>
			@endforeach
	    </tbody>		
	</table>
	<div class="col-sm-8 col-sm-offset-2 center">
		{{$users->addQuery('order',$order)->addQuery('sort', $sort)->links()}}
	</div>
	
</div>

@stop
