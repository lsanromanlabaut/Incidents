
@extends('layouts.app1')

@section('content')

	<div class="card">
                <div class="card-heating">
                    <h4 class="card-title" style="padding-top: 2rem; padding-left: 2rem;">Show the Incident</h4>
                </div>

                <div class="card-body">
                        <table class="table table-bordered">
                        	<thead>
                        		<tr>
                	        		<th >Code</th>
                	        		<th >Project</th>
                	        		<th >Category</th>
                	        		<th >Sending Date</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                        		<tr>
                	        		<td >{{$incident->id}}</td>
                	        		<td >{{$incident->project->name}}</td>
                	        		<td >{{$incident->category_name}}</td>
                	        		<td >{{$incident->created_at}}</td>
                        		</tr>
                        	</tbody>
                        	<thead>
                        		<tr>
                	        		<th >Assign To</th>
                	        		<th >Level</th>
                	        		<th >Status</th>
                	        		<th >Severity</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                        		<tr>
                	        		<td >{{$incident->support_name}}</td>
                	        		<td >{{$incident->level->name}}</td>
                	        		<td >{{$incident->status}}</td>
                	        		<td >{{$incident->severity_full}}</td>
                        		</tr>
                        	</tbody>

                        </table>
                        <br>
                        <table class="table table-bordered">
                        	<tbody>
                        		<tr>
                	        		<th>Title</th>
                	        		<td>{{$incident->title}}</td>
                	        	</tr>
                	        	<tr>
                	        		<th>Description</th>
                	        		<td>{{$incident->description}}</td>

                        		</tr>
                        		<tr>
                	        		<th>Files</th>
                	        		<td>Not Yet</td>
                        		</tr>
                        	</tbody>
                        </table>

                        <div>
                                @if ($incident->support_id == null && $incident->active && auth()->user()->canTake($incident))
                                        <a href="{{Route('incident.take', $incident->id)}}" class="btn btn-primary btn-sm" id="incident_btn_apply">
                                                Choose Incident
                                        </a>
                                @endif

                                @if (auth()->user()->id == $incident->client_id)
                                        @if ($incident->active)
                                                <a href="{{Route('incident.solve', $incident->id)}}" class="btn btn-info btn-sm" id="incident_btn_solve">
                                                        Mark as resolved
                                                </a>
                                                <a href="{{Route('incident.edit', $incident->id)}}" class="btn btn-success btn-sm" id="incident_btn_edit">
                                                        Edit Incident
                                                </a>
                                        @else
                                                <a href="{{Route('incident.open', $incident->id)}}" class="btn btn-info btn-sm" id="incident_btn_open">
                                                        Open Incident
                                                </a>
                                        @endif
                                @endif



                                @if (auth()->user()->id == $incident->support_id && $incident->active)
                                        <a href="{{Route('incident.nextlevel', $incident->id)}}" class="btn btn-danger btn-sm" id="incident_btn_derivate">
                                                Refer to the next level
                                        </a>
                                @endif
                        </div>

                        @include('layouts.chat')
                </div>
        </div>

@endsection