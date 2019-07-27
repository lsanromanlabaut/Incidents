
@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-heating">
            <h5 class="card-title" style="padding-top: 2rem; padding-left: 2rem;">Edit a Project</h5>
        </div>

        <div class="card-body">

            @include('include.errors')
            @include('include.message')

            <form method="POST" action="{{ route('project.update', $project) }}" class="was-validated">
                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="name" class="col-md-2">Name</label>
                    <input type="text" class="form-control col-md-4" name="name" placeholder="Name" value="{{ old('name', $project->name)  }}" required>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-2">Description</label>
                    <textarea class="form-control col-md-4" name="description" placeholder="Description" required>{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="form-group row">
                    <label for="startdate" class="col-md-2">Start Date</label>
                  	<input type="text" class="form-control col-md-4" name="startdate" id="startdate" placeholder="Start Date" value="{{ old('startdate', $project->startdate) }}" required>
                </div>

                <div class="form-group row">
                    <button class="btn btn-outline-success btn-pill">Update Project</button>
                </div>
            </form>

            <div class="row">
            	<div class="col-md-5">
            		<div class="card">
		            	<div class="card-heating"> <h4 style="margin-top: 20px;margin-left: 30px;">Categories</h4></div>
		            	<div class="card-body">
		            		<form method="POST" action="{{ route('category.storage', ['id' => $project->id])}}">
		            			@csrf
		            			<div class="form-group ">
				                  	<input type="text" class="form-control col-md-4" name="name" placeholder="Name" >
				                  	<textarea class="form-control col-md-10" placeholder="Description" name="description"></textarea>
				                  	<button class="btn btn-primary">Add Category</button>
				                </div>
		            		</form>

		            		<table class="table table-bordered">
			                    <thead>
			                        <tr>
			                            <th>Category</th>
			                            <th>Options</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        @foreach ($categories as $category)
			                            <tr>
			                                <td>{{$category->name}}</td>
			                                <td>
			                                    @if ($category->trashed())
			                                        <a href="{{route('category.restore', $category->id)}}"  title="Restore">
			                                            <i class="material-icons md-12">autorenew</i>
			                                        </a>
			                                    @else
				                                    <button type="button" class="btn btn-sm btn-primary" title="Edit" data-category="{{ $category->id }}">
				                                        <i class="material-icons md-12">edit</i>
				                                    </button>
				                                    <a href="{{route('category.delete', $category->id)}}"  title="Remove" class="btn btn-sm btn-primary">
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
            	<div class="col-md-7">
            		<div class="card">
            			<div class="card-heating"><h4 style="margin-top: 20px;margin-left: 30px;">Levels</h4></div>
            			<div class="card-body">
            				<form method="POST" class="" action="{{ route('level.storage', ['id' => $project->id])}}">
		            			@csrf
		            			<div class="form-group">
				                  	<input type="text" class="form-control col-md-4" name="name" placeholder="name" >
				                  	<button class="btn btn-primary">Add Level</button>
				                </div>
            				</form>
            				<table class="table table-bordered" style="width:100%">
			                    <thead>
			                        <tr>
			                            <th >Code</th>
			                            <th style="width: 35px">Name</th>
			                            <th style="width: 40px">Options</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        @foreach ($levels as $level)
			                            <tr>
			                                <td style="width: 25px">{{$level->code}}</td>
			                                <td style="width: 35px">{{$level->name}}</td>
			                                <td style="width: 40px">
			                                    @if ($level->trashed())
			                                        <a href="{{ route('level.restore', $level->id) }}"  title="Restore">
			                                            <i class="material-icons md-12">autorenew</i>
			                                        </a>
			                                    @else
				                                    <button type="button" class="btn btn-sm btn-primary" title="Edit" data-level="{{ $level->id }}">
				                                        <i class="material-icons md-12">edit</i>
				                                    </button>
				                                    <a href="{{route('level.delete', $level->id)}}"  title="Remove" class="btn btn-sm btn-primary">
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
            </div>
        </div>
    </div>

	<!-- Modal for category-->
	<div class="modal fade" id="EditCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  		<span aria-hidden="true">&times;</span>
					</button>
				</div>
		      	<form method="POST" action="{{ route('category.updated')}}">
		      		<div class="modal-body">
			        	@csrf
			        	<div class="form-group row">
			        		<input type="hidden" name="category_id" id="category_id" value="">
			                <div class="row">
			                	<label for="name" class="col-md-4">Name</label>
			                	<input type="text" class="form-control col-md-4" name="name" id="category_name" placeholder="Category Name" required>
			                </div>
		            	</div>
		      		</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Update</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
		        </form>
		    </div>
	  	</div>
	</div>

	<!-- Modal for Level-->
	<div class="modal fade" id="editLevelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Level</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  		<span aria-hidden="true">&times;</span>
					</button>
				</div>
		      	<form method="POST" action="{{ route('level.updated')}}">
		      		<div class="modal-body">
			        	@csrf
			        	<div class="form-group row">
			        		<input type="hidden" name="level_id" id="level_id">
			                <label for="name" class="col-md-4">Level Name</label>
			                <input type="text" class="form-control col-md-4" name="name" placeholder="Level Name" id="level_name" required>
		            	</div>
		      		</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Update</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
		        </form>
		    </div>
	  	</div>
	</div>
@endsection

@section('scripts')
	<script src="/js/projectEdit.js"></script>
@endsection