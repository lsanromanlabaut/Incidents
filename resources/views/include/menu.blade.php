@if (auth()->check())
	<div class="card" style="width: 15rem; ">
		<div class="card-header bg-dark text-light" id="card-header-menu">
			Menu
		</div>
		<ul class="list-group list-group-flush" id="card-body-menu">
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
						<li class="list-group-item"><a href="{{route('project.index')}}" >Projects</a></li>
					</ul>
				</li>
			@endif
		</ul>
	</div>
@endif


