@extends('_master')

@section('title')
Create User
@stop

@section('content')



<div class="p-body-wrapper col-sm-8 col-sm-offset-2">
	<div class="col-sm-12 center page-title">
		<h1>Create User</h1>
	</div>

	@if(Session::get('flash_message'))
	<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info alert-dismissible' role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		{{ Session::get('flash_message') }}
	</div>
	@endif

	{{ Form::open(array('url' => '/create-user')) }}

	<div class="col-sm-6 " >
		<div class="form-group col-sm-12 @if($errors->first('firstname')) has-error @endif ">
			<label for="firstname">First Name</label>
			{{ Form::text('firstname', '', array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('firstname')}}</div>
		</div>

		<div class="form-group col-sm-12 @if($errors->first('lastname')) has-error @endif ">
			<label for="lastname">Last Name</label>
			{{ Form::text('lastname', '', array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('lastname')}}</div>
		</div>

		@if( Auth::user()->can('create_all_users') )
		<div class="form-group col-sm-12 @if($errors->first('company_id')) has-error @endif ">
			<label for="company">Company</label>
			{{ Form::select('company_id', $companies, '', array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('company_id')}}</div>
		</div>
		@elseif (Auth::user()->can('create_users_for_company'))
		{{Form::hidden('company_id', Auth::user()->company->id)}}
		@endif

		<div class="form-group col-sm-12 @if($errors->first('role')) has-error @endif ">
			<label for="role">Role</label>
			{{ Form::select('role', $roles, '', array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('role')}}</div>
		</div>

	</div>

	<div class="col-sm-6">
		<div class="form-group col-sm-12 @if($errors->first('email')) has-error @endif ">
			<label for="email">Email</label>
			{{ Form::text('email', '', array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('email')}}</div>
		</div>

		<div class="form-group col-sm-12 @if($errors->first('password')) has-error @endif ">
			<label for="password">Password</label>
			{{ Form::password('password', array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('password')}}</div>
		</div>					

		<div class="form-group col-sm-12">
			<label for="phone">Phone</label>
			{{ Form::text('phone', '', array('class' => 'form-control')) }}
		</div>

	</div>

	<div class="col-sm-12 center">
		{{ Form::submit('Create', array('class' => 'btn btn-default')) }}
	</div>
	
	{{ Form::close() }}
</div>

@stop
