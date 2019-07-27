@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-heating">
            <h5 class="card-title" style="padding-top: 2rem; padding-left: 2rem;">Create a new User</h5>
        </div>

        <div class="card-body">

            @include('include.errors')
            @include('include.message')

            <form method="POST" action="{{ route('user.store') }}" class="was-validated">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-2">E-mail</label>
                    <input type="email" class="form-control col-md-4" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-2">Name</label>
                    <input type="text" class="form-control col-md-4" name="name" placeholder="Name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-2">Password</label>
                    <input type="text" class="form-control col-md-4" name="password" placeholder="Password" value="{{ old('password','123456') }}" required>
                </div>

                <div class="form-group row">
                    <button class="btn btn-outline-success btn-pill">Create User</button>
                </div>

            </form>
            <br>
            <br>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>E-mail</th>
                            <th>Name</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->email}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <a href="{{route('user.edit', $user->id)}}" title="Edit">
                                        <i class="material-icons md-24">edit</i>
                                    </a>
                                    <a href="{{route('user.delete', $user->id)}}"  title="Remove">
                                        <i class="material-icons md-24">delete</i>
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