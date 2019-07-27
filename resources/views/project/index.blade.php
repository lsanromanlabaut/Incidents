@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-heating">
            <h5 class="card-title" style="padding-top: 2rem; padding-left: 2rem;">Create a new Project</h5>
        </div>

        <div class="card-body">

            @include('include.errors')
            @include('include.message')

            <form method="POST" action="{{ route('project.store') }}" class="was-validated">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-2">Name</label>
                    <input type="text" class="form-control col-md-4" name="name" placeholder="Name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-2">Description</label>
                    <textarea class="form-control col-md-4" name="description" placeholder="Description" required="">{{ old('description') }}</textarea>
                </div>

                <div class="form-group row">
                    <label for="startdate" class="col-md-2">Start Date</label>
                  	<input type="text" class="form-control col-md-4" name="startdate" id="startdate" placeholder="Start Date" required>
                </div>

                <div class="form-group row">
                    <button class="btn btn-outline-success btn-pill">Create Project</button>
                </div>

            </form>
            <br>
            <br>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{$project->name}}</td>
                                <td>{{$project->description}}</td>
                                <td>{{$project->startdate}}</td>
                                <td>
                                    @if ($project->trashed())
                                        <a href="{{route('project.restore', $project->id)}}"  title="Restore" class="btn btn-sm btn-primary">
                                            <i class="material-icons md-12">autorenew</i>
                                        </a>
                                    @else
                                        <a href="{{route('project.edit', $project->id)}}" title="Edit" class="btn btn-sm btn-primary">
                                            <i class="material-icons md-12">edit</i>
                                        </a>
                                        <a href="{{route('project.delete', $project->id)}}"  title="Remove" class="btn btn-sm btn-primary">
                                            <i class="material-icons md-12">delete</i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
	<script>
		$('#startdate').datepicker({
			format: 'yyyy/mm/dd'
		});
	</script>

@endsection