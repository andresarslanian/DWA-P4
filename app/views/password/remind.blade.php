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
	Enter your email below to reset your password.
	<form action="{{ action('RemindersController@postRemind') }}" method="POST">
		<div class="form-group col-sm-12">
			{{ Form::text('email', '', array('class' => 'form-control')) }}
		</div>		

		<div class="col-sm-12 right-align">
			{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
		</div>
	</form>
</div>	
@stop
