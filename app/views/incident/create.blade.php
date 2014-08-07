@extends('_master')

@section('title')
	Create Incident
@stop

@section('content')

	
	<div class=" p-body-wrapper col-sm-10 col-sm-offset-1">
		<div class="col-sm-12 center page-title">
			<h1>Create Incident</h1>
		</div>

		@if(Session::get('flash_message'))
		<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info alert-dismissible' role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			{{ Session::get('flash_message') }}
		</div>
		@endif

		{{ Form::open(array('url' => '/create-incident')) }}

			<div class="col-sm-5">
				<div class="form-group col-sm-12 @if($errors->first('address')) has-error @endif">
				    <label for="address">Address</label>
					{{ Form::text('address', '', array('class' => 'form-control')) }}
					<div class="validation-message-error">{{$errors->first('address')}}</div>
				</div>
							
				
				<div class="form-group col-sm-12">
				    <label for="description">Description</label>
					{{Form::textarea('description','',array('rows' => '5','class' => 'form-control'))}}
				</div>


			</div>

			<div class="col-sm-4">
				<div class="form-group col-sm-6 @if($errors->first('house_number')) has-error @endif">
				    <label for="house_number">House #</label>
					{{ Form::text('house_number', '', array('class' => 'form-control')) }}
					<div class="validation-message-error">{{$errors->first('house_number')}}</div>
				</div>

				<div class="form-group col-sm-6 @if($errors->first('picket_number')) has-error @endif">
				    <label for="picket_number">Picket #</label>
					{{ Form::text('picket_number', '', array('class' => 'form-control')) }}
					<div class="validation-message-error">{{$errors->first('picket_number')}}</div>
				</div>	

				<div class="form-group col-sm-12 @if($errors->first('hw_address')) has-error @endif">
				    <label for="hw_address">HW Address</label>
					{{ Form::text('hw_address', '', array('class' => 'form-control')) }}
					<div class="validation-message-error">{{$errors->first('hw_address')}}</div>
				</div>



			</div>

			<div class="col-sm-3">

				<div class="form-group col-sm-12 @if($errors->first('type_id')) has-error @endif">
				    <label for="type_id">Incident</label>
					{{ Form::select('type_id', $incidents, '', array('class' => 'form-control')) }}
					<div class="validation-message-error">{{$errors->first('type_id')}}</div>
				</div>

				<div class="form-group col-sm-12 @if($errors->first('owner_id')) has-error @endif">
				    <label for="owner_id">Owner</label>
					{{ Form::select('owner_id', $companies, '', array('class' => 'form-control')) }}
					<div class="validation-message-error">{{$errors->first('owner_id')}}</div>
				</div>			
				
				<div class="form-group col-sm-12 @if($errors->first('lamp_type_id')) has-error @endif">
				    <label for="lamp_type_id">Lamp Type</label>
					{{ Form::select('lamp_type_id', $lamp_types, '', array('class' => 'form-control')) }}
					<div class="validation-message-error">{{$errors->first('lamp_type_id')}}</div>
				</div>
			</div>

			<div class="col-sm-12 center">
				{{ Form::submit('Create', array('class' => 'btn btn-default')) }}
			</div>
		
		{{ Form::close() }}
	</div>

@stop
