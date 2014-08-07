@extends('_master')

@section('title')
Users
@stop

@section('content')


<div class="p-body-wrapper col-sm-10 col-sm-offset-1">
	<div class="col-sm-12 center page-title">
		<h1>Users</h1>
	</div>

	@if(Session::get('flash_message'))
	<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info alert-dismissible' role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		{{ Session::get('flash_message') }}
	</div>
	@endif
	@if( Auth::user()->can('create_users_for_company') )
	<a href="/create-user" class="btn btn-primary col-sm-2">Add new user</a>
	@endif

	@if( Auth::user()->worksFor('Philips') )
	{{ Form::open(array('url' => '/list-users', 'class' => 'form-horizontal','method' => 'POST')) }}
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
				<th>Role</th>
				<th></th>
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
				<td>{{$user->roles()->first()->name}}</td>
				<td>
					<a href="/show-user/{{$user->id}}" class="btn btn-success">View</a>
					@if( Auth::user()->can('modify_users_for_company'))
					<a href="/edit-user/{{$user->id}}" class="btn btn-success">Edit</a>
					@endif
				</td>				
			</tr>
			@endforeach
		</tbody>		
	</table>
	<div class="col-sm-8 col-sm-offset-2 center">
		{{$users->addQuery('order',$order)->addQuery('sort', $sort)->links()}}
	</div>
	
</div>

@stop
