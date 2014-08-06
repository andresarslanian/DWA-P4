@extends('_master')

@section('title')
View User
@stop

@section('content')

<div class="col-sm-offset-5 col-sm-7">
	<h1>User {{$user->id}}</h1>
</div>

@if(Session::get('flash_message'))
<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info' role="alert">{{ Session::get('flash_message') }}</div>
@endif		

<div class="col-sm-8 col-sm-offset-2 signup-container forms-container">


	<div class="col-sm-6 " >
		<div class="form-group col-sm-12 @if($errors->first('firstname')) has-error @endif ">
			<label for="firstname">First Name</label>
			{{ Form::text('firstname', $user->firstname, array('class' => 'form-control','readonly'=>'')) }}
		</div>

		<div class="form-group col-sm-12 @if($errors->first('lastname')) has-error @endif ">
			<label for="lastname">Last Name</label>
			{{ Form::text('lastname', $user->lastname, array('class' => 'form-control','readonly'=>'')) }}
		</div>

		<div class="form-group col-sm-12 @if($errors->first('company_id')) has-error @endif ">
			<label for="company">Company</label>
			{{ Form::text('lastname', $user->company->name, array('class' => 'form-control','readonly'=>'')) }}
		</div>

	</div>

	<div class="col-sm-6">
		<div class="form-group col-sm-12 @if($errors->first('email')) has-error @endif ">
			<label for="email">Email</label>
			{{ Form::text('lastname', $user->email, array('class' => 'form-control','readonly'=>'')) }}
		</div>

		<div class="form-group col-sm-12">
			<label for="phone">Phone</label>
			{{ Form::text('lastname', $user->phone, array('class' => 'form-control','readonly'=>'')) }}
		</div>

		<div class="form-group col-sm-12 @if($errors->first('role')) has-error @endif ">
			<label for="role">Role</label>
			{{ Form::text('lastname', $user->roles()->first()->name, array('class' => 'form-control','readonly'=>'')) }}
		</div>

	</div>

	<div class="col-sm-12 center">
		@if( Auth::user()->can('modify_users_for_company'))
		<a href="/list-users/" class="btn btn-default">Back</a>
		<a href="/edit-user/{{$user->id}}" class="btn btn-default">Edit</a>
		@endif
	</div>

</div>

@stop
