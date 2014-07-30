
<table class="table table-striped table-hover list-table">
	<thead>
		<tr>
			<th>id</th>
			<th>Created</th>
			<th>Replaced By</th>
			<th>Lamp Serial</th>
			<th>Lamp Type</th>
			<th>Comment</th>

		</tr>
	</thead>
	<tbody>
		@foreach ($replacements as $replacement)
			<tr>
				<td>{{$replacement->id}}</td>
				<td>{{$replacement->created_at}}</td>
				<td>{{$replacement->user->firstname.' '.$replacement->user->lastname}}</td>
				<td>
					@if ($replacement->lamp)
						{{$replacement->lamp->serial}}
					@else
						-
					@endif
				</td>				
				<td>
					@if ($replacement->lamp)
						{{$replacement->lamp->type->description}}
					@else
						-
					@endif
				</td>
				<td>{{$replacement->comments}}</td>
				</tr>
		@endforeach
    </tbody>		
</table>


