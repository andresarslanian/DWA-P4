@extends('_master')

@section('title')
Edit User
@stop

@section('content')
<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete User</h4>
			</div>
			{{ Form::open(array('url' => '/delete-user'))}}
			<div class="modal-body">
				{{Form::hidden('user_id',$user->id)}}
				Are you sure? Once you delete the user you won't be able to make another account with the same email:
				{{$user->email}}	

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelDeleteUser">Cancel</button>
				{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
			</div>
			{{ Form::close() }}	
		</div>
	</div>
</div>


<div class="col-sm-offset-5 col-sm-7">
	<h1>Edit User</h1>
</div>

@if(Session::get('flash_message'))
<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info' role="alert">{{ Session::get('flash_message') }}</div>
@endif		

<div class="col-sm-8 col-sm-offset-2 signup-container forms-container">


	{{ Form::open(array('url' => '/edit-user')) }}
	{{Form::hidden('user_id',$user->id)}}
	<div class="col-sm-6 " >
		<div class="form-group col-sm-12 @if($errors->first('firstname')) has-error @endif ">
			<label for="firstname">First Name</label>
			{{ Form::text('firstname', $user->firstname, array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('firstname')}}</div>
		</div>


		<div class="form-group col-sm-12 @if($errors->first('email')) has-error @endif ">
			<label for="email">Email</label>
			{{ Form::text('email', $user->email, array('class' => 'form-control', 'readonly'=>'')) }}
			<div class="validation-message-error">{{$errors->first('email')}}</div>
		</div>

		<div class="form-group col-sm-12 @if($errors->first('company_id')) has-error @endif ">
			<label for="company">Company</label>
			{{ Form::text('read_comp', $user->company->name, array('class' => 'form-control','readonly'=>'')) }}
		</div>

	</div>

	<div class="col-sm-6">
		<div class="form-group col-sm-12 @if($errors->first('lastname')) has-error @endif ">
			<label for="lastname">Last Name</label>
			{{ Form::text('lastname', $user->lastname, array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('lastname')}}</div>
		</div>


		<div class="form-group col-sm-12">
			<label for="phone">Phone</label>
			{{ Form::text('phone', $user->phone, array('class' => 'form-control')) }}
		</div>

		<div class="form-group col-sm-12 @if($errors->first('role')) has-error @endif ">
			<label for="role">Role</label>
			{{ Form::select('role', $roles, $user->roles()->first()->id, array('class' => 'form-control')) }}
			<div class="validation-message-error">{{$errors->first('role')}}</div>
		</div>


	</div>

	<div class="col-sm-6 col-sm-offset-2 center">
		{{ Form::submit('Update', array('class' => 'btn btn-default')) }}
		<a href="/show-user/{{$user->id}}" class="btn btn-default">Cancel</a>
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
	$("#cancelDeleteUser").click(function(){
		$('#modalDelete').modal('hide');
		return false;
	});
</script>

@stop