@extends('_master')

@section('title')
	Sign up
@stop

@section('content')

	<h1>Sign up</h1>
	
	{{ Form::open(array('url' => '/signup')) }}

		Email<br>
		{{ Form::text('email') }}<br><br>

		Password:<br>
		{{ Form::password('password') }}<br><br>

		Firstname<br>
		{{ Form::text('firstname') }}<br><br>
	
		Lastname<br>
		{{ Form::text('lastname') }}<br><br>

		Phone<br>
		{{ Form::text('phone') }}<br><br>		

		Company<br>
		{{Form::select('company_id', $companies)}}

		{{ Form::submit('Submit') }}
	
	{{ Form::close() }}

@stop
