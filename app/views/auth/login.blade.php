@extends('_master')

@section('title')
	Philips - Led Replacement Manager
@stop

@section('content')

	<div class="col-sm-offset-3 col-sm-9">
	<h1>Philips Led Replacement Management</h1>
	</div>

	@if(Session::get('flash_message'))
		<div class='flash-message col-sm-3 col-sm-offset-5 login-alert center alert alert-info' role="alert">{{ Session::get('flash_message') }}</div>
	@endif
	<div class="col-sm-offset-5 login-container col-sm-3">
		{{ Form::open(array('url' => '/login')) }}
					
			<div class="form-group col-sm-12">
			    <label for="email">Email</label>
				{{ Form::text('email', '', array('class' => 'form-control')) }}
			</div>					

					
			<div class="form-group col-sm-12">
			    <label for="password">Password</label>
				{{ Form::password('password', array('class' => 'form-control')) }}
			</div>					


			<div class="col-sm-12 right-align">
				{{ Form::submit('Login', array('class' => 'btn btn-default')) }}
			</div>

		{{ Form::close() }}
	</div>	
@stop
