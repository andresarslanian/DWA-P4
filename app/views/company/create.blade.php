@extends('_master')

@section('title')
Create Company
@stop

@section('content')

<div class="p-body-wrapper col-sm-4 col-sm-offset-4">
		<div class="col-sm-12 center page-title">
			<h1>Create Company</h1>
		</div>

		@if(Session::get('flash_message'))
		<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info alert-dismissible' role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			{{ Session::get('flash_message') }}
		</div>
		@endif

	{{ Form::open(array('url' => '/create-company')) }}

	<div class="col-sm-12 " >
		<div class="form-group col-sm-12 @if($errors->first('name')) has-error @endif ">
			<label for="name">Name</label>
			{{ Form::text('name', '', array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('name')}}</div>
		</div>

		<div class="form-group col-sm-12">
			<label for="phone">Phone</label>
			{{ Form::text('phone', '', array('class' => 'form-control')) }}
		</div>

		<div class="form-group col-sm-12 @if($errors->first('email')) has-error @endif ">
			<label for="email">Email</label>
			{{ Form::text('email', '', array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('email')}}</div>
		</div>

	</div>

	
	
	<div class="col-sm-12 center">
		{{ Form::submit('Create', array('class' => 'btn btn-default')) }}
	</div>

	{{ Form::close() }}
</div>

@stop
