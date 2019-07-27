@extends('layouts.app')

@section('content')

        <div class="card text-left">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (auth()->user()->is_support)
                    <div>
                        <h5>Incidents assigned to me</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Severity</th>
                                    <th>Status</th>
                                    <th>Creation Date</th>
                                    <th>Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($my_incidents as $incident)
                                    <tr>
                                        <td>
                                            <a href="{{ Route('incident.show', $incident->id)}}">
                                                {{$incident->id}}
                                            </a>
                                        </td>
                                        <td>{{$incident->category->name}}</td>
                                        <td>{{$incident->severity_full}}</td>
                                        <td>{{$incident->status}}</td>
                                        <td>{{$incident->created_at}}</td>
                                        <td>{{$incident->title_full}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h5>Unassigned incidents</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Severity</th>
                                    <th>Status</th>
                                    <th>Creation Date</th>
                                    <th>Title</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unassigned_incidents as $unassigned_incident)
                                    <tr>
                                        <td>
                                            <a href="{{ Route('incident.show', $unassigned_incident->id)}}">
                                                {{$unassigned_incident->id}}
                                            </a>
                                        </td>
                                        <td>{{$unassigned_incident->category->name}}</td>
                                        <td>{{$unassigned_incident->severity_full}}</td>
                                        <td>{{$unassigned_incident->status}}</td>
                                        <td>{{$unassigned_incident->created_at}}</td>
                                        <td>{{$unassigned_incident->title_full}}</td>
                                        <td>
                                            <a href="#" title="attend" class="btn btn-sm btn-primary">
                                            <i class="material-icons md-12">assignment_turned_in</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <div>
                    <h5>Incidents reported by me</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Severity</th>
                                <th>Status</th>
                                <th>Creation Date</th>
                                <th>Title</th>
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incidents_by_me as $incident_by_me)
                                <tr>
                                    <td>
                                        <a href="{{ Route('incident.show', $incident_by_me->id)}}">
                                            {{$incident_by_me->id}}
                                        </a>
                                    </td>
                                    <td>{{$incident_by_me->category_name}}</td>
                                    <td>{{$incident_by_me->severity_full}}</td>
                                    <td>{{$incident_by_me->status}}</td>
                                    <td>{{$incident_by_me->created_at}}</td>
                                    <td>{{$incident_by_me->title_full}}</td>
                                    <td>{{$incident_by_me->support_id?:'not Assigned'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <div>
        </div>

@endsection
