@extends('_master')

@section('title')
Edit Company
@stop

@section('content')
<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete Company</h4>
			</div>
			{{ Form::open(array('url' => '/delete-company'))}}
			<div class="modal-body">
				{{Form::hidden('company_id',$company->id)}}
				Are you sure? Once you delete the company also you will be deleting all the users and you won't be able to recover them.	

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelDeleteCompany">Cancel</button>
				{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
			</div>
			{{ Form::close() }}	
		</div>
	</div>
</div>

<div class="col-sm-offset-5 col-sm-7">
	<h1>Company {{$company->id}}</h1>
</div>

@if(Session::get('flash_message'))
<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info' role="alert">{{ Session::get('flash_message') }}</div>
@endif		

<div class="col-sm-4 col-sm-offset-4 signup-container forms-container">

	{{ Form::open(array('url' => '/edit-company')) }}
	{{Form::hidden('company_id',$company->id)}}
	<div class="col-sm-12 " >
		<div class="form-group col-sm-12 @if($errors->first('name')) has-error @endif ">
			<label for="name">Name</label>
			{{ Form::text('name', $company->name, array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('name')}}</div>
		</div>

		<div class="form-group col-sm-12">
			<label for="phone">Phone</label>
			{{ Form::text('phone', $company->phone, array('class' => 'form-control')) }}
		</div>

		<div class="form-group col-sm-12 @if($errors->first('email')) has-error @endif ">
			<label for="email">Email</label>
			{{ Form::text('email', $company->email, array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('email')}}</div>
		</div>
	</div>

	
	
	<div class="col-sm-6 col-sm-offset-2 center">
		{{ Form::submit('Update', array('class' => 'btn btn-default')) }}
		<a href="/show-company/{{$company->id}}" class="btn btn-default">Cancel</a>
	</div>

	{{ Form::close() }}
	

	<div class="col-sm-4 center">

		<button class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">
			Delete
		</button>

	</div>

	
</div>

@stop


@section('body')
<script type="text/javascript">
	$("#cancelDeleteCompany").click(function(){
		$('#modalDelete').modal('hide');
		return false;
	});
</script>

@stop
