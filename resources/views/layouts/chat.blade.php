
<br>
@include('include.errors')
@include('include.message')
<table class="table table-bordered">
	<thead class="bg-primary">
		<tr>
			<th class="text-white">Discussion</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($messages as $message)
			<tr>
				<td>
					<div class="media">
						@if ($message->user->is_client)
							<i class="material-icons md-36" style="margin-right: 10px">face</i>
						@elseif ($message->user->is_support)
							<i class="material-icons md-36" style="margin-right: 10px">perm_identity</i>
						@endif
						<div class="media-body">
							<span class="text-info">{{$message->message}}</span>
							<br>
							<small class="text-muted">
								{{$message->user->name}} | {{$message->created_at}}
							</small>
						</div>
					</div>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div>
	<form method="POST" action="{{Route('message.store')}}">
		<div class="input-group">
			@csrf
			<input type="hidden" name="incident_id" value="{{$incident->id}}">
			<input type="text" name="message" class="form-control" required="">
			<span class="input-group-btn">
				<button class="btn btn-default">Send</button>
			</span>
		</div>
	</form>
</div>


