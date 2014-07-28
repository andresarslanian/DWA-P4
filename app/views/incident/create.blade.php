@extends('_master')

@section('title')
	Create Incident
@stop

@section('content')

	<div class="col-sm-offset-5 col-sm-7">
	<h1>Create Incident</h1>
	</div>
	@if(Session::get('flash_message'))
		<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info' role="alert">{{ Session::get('flash_message') }}</div>
	@endif		
	<div class="col-sm-10 col-sm-offset-1 signup-container forms-container">
		{{ Form::open(array('url' => '/create-incident')) }}

			<div class="col-sm-5">
				<div class="form-group col-sm-12">
				    <label for="address">Address</label>
					{{ Form::text('address', '', array('class' => 'form-control')) }}
				</div>



				<div class="form-group col-sm-12">
				    <label for="hw_address">HW Address</label>
					{{ Form::text('hw_address', '', array('class' => 'form-control')) }}
				</div>

								
				
				<div class="form-group col-sm-12">
				    <label for="description">Description</label>
					{{ Form::text('description', '', array('class' => 'form-control')) }}
				</div>


			</div>

			<div class="col-sm-4">
				<div class="form-group col-sm-6">
				    <label for="house_number">House #</label>
					{{ Form::text('house_number', '', array('class' => 'form-control')) }}
				</div>

				<div class="form-group col-sm-6">
				    <label for="picket_number">Picket #</label>
					{{ Form::text('picket_number', '', array('class' => 'form-control')) }}
				</div>	

				<div class="form-group col-sm-12">
				    <label for="lamp_type">Type of Lamp</label>
					{{ Form::text('lamp_type', '', array('class' => 'form-control')) }}
				</div>

				<div class="form-group col-sm-12 ">
				    <label for="state_id">State</label>
					{{ Form::select('state_id', $states, '', array('class' => 'form-control')) }}
				</div>				
			</div>

			<div class="col-sm-3">

				<div class="form-group col-sm-12 ">
				    <label for="type_id">Incident</label>
					{{ Form::select('type_id', $incidents, '', array('class' => 'form-control')) }}
				</div>

				
				<div class="form-group col-sm-12 ">
				    <label for="owner_id">Owner</label>
					{{ Form::select('owner_id', $companies, '', array('class' => 'form-control')) }}
				</div>

				<div class="form-group col-sm-12 ">
				    <label for="action_id">Action</label>
					{{ Form::select('action_id', $actions, '', array('class' => 'form-control')) }}
				</div>				

			</div>

			<div class="col-sm-12 center">
				{{ Form::submit('Create', array('class' => 'btn btn-default')) }}
			</div>
		
		{{ Form::close() }}
	</div>

@stop
