@extends('layouts.app1')

@section('content')

    <div class="card">
        <div class="card-heating">
            <h4 class="card-title" style="padding-top: 2rem; padding-left: 2rem;">Create a new Incident</h4>
        </div>

        <div class="card-body">

            @include('include.errors')
            @include('include.message')

            <form method="POST" action="{{ route('incident.store') }}" class="was-validated">
                @csrf

                <div class="form-group row">
                    <label for="category_id" class="col-md-2">Category</label>
                    <select name="category_id" class="form-control col-md-3">
                        <option value="">General</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label for="severity" class="col-md-2">Severity</label>
                    <select name="severity" class="form-control col-md-3">
                        <option value="l"> Low </option>
                        <option value="n"> Normal </option>
                        <option value="h"> High </option>
                    </select>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-2">Title</label>
                    <input type="text" class="form-control col-md-5" name="title" placeholder="title" value="{{ old('title') }}" required>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-2">Description</label>
                    <textarea class="form-control col-md-5" placeholder="Description" name="description" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group row">
                    <button class="btn btn-outline-success btn-pill">Create Incident</button>
                </div>

            </form>
        </div>
    </div>

@endsection