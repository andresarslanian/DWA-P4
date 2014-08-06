@extends('_master')

@section('title')
Show Company
@stop

@section('content')

<div class="col-sm-offset-5 col-sm-7">
	<h1>Company {{$company->id}}</h1>
</div>

@if(Session::get('flash_message'))
<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info' role="alert">{{ Session::get('flash_message') }}</div>
@endif		

<div class="col-sm-4 col-sm-offset-4 signup-container forms-container">


	<div class="col-sm-12 " >
		<div class="form-group col-sm-12 @if($errors->first('name')) has-error @endif ">
			<label for="name">Name</label>
			{{ Form::text('name', $company->name, array('class' => 'form-control','readonly'=>'')) }}
			<div class="validation-message-error">{{$errors->first('name')}}</div>
		</div>

		<div class="form-group col-sm-12">
			<label for="phone">Phone</label>
			{{ Form::text('phone', $company->phone, array('class' => 'form-control','readonly'=>'')) }}
		</div>

		<div class="form-group col-sm-12 @if($errors->first('email')) has-error @endif ">
			<label for="email">Email</label>
			{{ Form::text('email', $company->email, array('class' => 'form-control','readonly'=>'')) }}
			<div class="validation-message-error">{{$errors->first('email')}}</div>
		</div>

	</div>

	<div class="col-sm-12 center">
		@if( Auth::user()->can('modify_companies'))
		<a href="/list-companies/" class="btn btn-default">Back</a>
		<a href="/edit-company/{{$company->id}}" class="btn btn-default">Edit</a>
		@endif
	</div>	
	
</div>

@stop
