@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-heating">
            <h5 class="card-title" style="padding-top: 2rem; padding-left: 2rem;">Edit User</h5>
        </div>

        <div class="card-body">

            @include('include.errors')
            @include('include.message')

            <form method="POST" action="{{ route('user.update', $user) }}" class="was-validated">
                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="email" class="col-md-2">E-mail</label>
                    <input type="email" class="form-control col-md-4" readonly name="email" placeholder="Email" value="{{$user->email}}" required>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-2">Name</label>
                    <input type="text" class="form-control col-md-4" name="name" placeholder="Name" value="{{ $user->name }}" required>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5">If you want to change the password</label>
                    <input type="text" class="form-control col-md-4" name="password" placeholder="Password" value="">
                </div>

                <div class="form-group row">
                    <button class="btn btn-outline-success btn-pill">Save User</button>
                </div>

            </form>
            <br>
            <form method="POST" action="{{Route('project-user.store')}}" >
                <div class="row">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="col-md-4">
                        <select name="select-project" class="form-control" id="select-project">
                            <option value="">Select a Project</option>
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="select-level" class="form-control" id="select-level">
                            <option value="">Select a Level</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-sm btn-primary">Add</button>
                    </div>
                </div>
            </form>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Levels</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project_users as $project_user)
                            <tr>
                                <td>{{$project_user->project->name}}</td>
                                <td>{{$project_user->level->name}}</td>
                                <td>
                                    <a href="{{Route('project-user.delete', $project_user->id)}}"  title="Remove" class="btn btn-sm btn-primary">
                                        <i class="material-icons md-12">delete</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="/js/userEdit.js"></script>
@endsection
