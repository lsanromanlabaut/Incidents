<div class="panel panel-primary">
	<div class="panel-heading">Menu</div>
	<div class="panel-body">
		<div class="list-group">
			@if (auth()->check())
				<ul>
					<li class="list-group-item"><a href="/home" >Dashboard</a></li>

					@if (! auth()->user()->is_client)
						<li class="list-group-item"><a href="{{route('incident.index')}}">Incident list</a></li>
					@endif

					<li class="list-group-item"><a href="{{route('incident.create')}}">Report Incidents</a></li>

					@if (auth()->user()->is_admin)
						<li class="dropdown list-group-item">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration</a>
							<ul class="dropdown-menu">
								<li class="list-group-item"><a href="{{route('user.index')}}" >Users</a></li>
								<li class="list-group-item"><a href="{{route('project.index')}}">Projects</a></li>
								<li class="list-group-item"><a href="#">Configuration</a></li>
							</ul>
						</li>
					@endif
				</ul>
			@else
				<ul>
					<li class="list-group-item"><a href="#">Welcome</a></li>
					<li class="list-group-item"><a href="#">Instruction</a></li>
					<li class="list-group-item"><a href="#">Credits</a></li>
				</ul>
			@endif
		</div>
	</div>
</div>