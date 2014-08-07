@extends('_master')

@section('title')
	Create Replacement
@stop

@section('content')

	
	<div class="p-body-wrapper col-sm-10 col-sm-offset-1">

	<div class="col-sm-12 center page-title">
		<h1>Create Replacement</h1>
	</div>

	@if(Session::get('flash_message'))
	<div class='flash-message col-sm-4 col-sm-offset-4 login-alert center alert alert-info alert-dismissible' role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		{{ Session::get('flash_message') }}
	</div>
	@endif

		{{ Form::open(array('url' => '/store-replacement')) }}
			{{Form::hidden("incident_id", $incident_id)}}
			<div class="col-sm-6">
				<div class="form-group col-sm-12">
				    <label for="comments">Comments</label>
					{{Form::textarea('comments','',array('rows' => '5','class' => 'form-control'))}}
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group col-sm-12 @if($errors->first('lamp_id')) has-error @endif">
				    <label for="lamp_id">Lamp</label><br>
					{{ Form::select('lamp_id', $lamps, '', array('class' => 'form-control chosen-select-lamp chosen-select-deselect', 'data-placeholder'=>"Type or Browse Lamps Serials")) }}
					<div class="validation-message-error">{{$errors->first('lamp_id')}}</div>
				</div>
			</div>

			<div class="col-sm-12 center">
				{{ Form::submit('Create', array('class' => 'btn btn-default')) }}
			</div>
		
		{{ Form::close() }}
	</div>

@stop

@section('body')
	<script type="text/javascript">
		$(function(){
			$(".chosen-select-deselect").chosen({no_results_text:'Oops, nothing found!', allow_single_deselect: true});
		});		
	</script>
@stop
