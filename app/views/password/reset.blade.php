@extends('_master')

@section('title')
Philips - Led Replacement Manager
@stop

@section('content')

<div class="col-sm-offset-3 col-sm-9">
	<h1>Philips Led Replacement Management</h1>
</div>

@if(Session::get('status'))
<div class='flash-message col-sm-3 col-sm-offset-5 login-alert center alert alert-info' role="alert">{{ Session::get('status') }}</div>
@endif
<div class="col-sm-offset-5 login-container col-sm-3">
	Please complete the form below to reset your password.
	<form action="{{ action('RemindersController@postReset') }}" method="POST">
		<input type="hidden" name="token" value="{{ $token }}">
		<div class="form-group col-sm-12">
			<label for="email">Email</label>		
			{{ Form::text('email', '', array('class' => 'form-control')) }}
		</div>		
		<div class="form-group col-sm-12">
			<label for="Password">Password</label>	
			{{ Form::password('password', array('class' => 'form-control')) }}	
		</div>		
		<div class="form-group col-sm-12">
			<label for="password_confim">Password Confirmation</label>		
			{{ Form::password('password', array('class' => 'form-control')) }}
		</div>		


		<div class="col-sm-12 right-align">
			{{ Form::submit('Reset Password', array('class' => 'btn btn-default')) }}
		</div>
		
	</form>
</div>	
@stop
