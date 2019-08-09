@extends('layouts.app1')

@section('content')

    <div class="card">
        <div class="card-heating">
            <h4 class="card-title" style="padding-top: 2rem; padding-left: 2rem;">Edit Incident</h4>
        </div>

        <div class="card-body">

            @include('include.errors')
            @include('include.message')

            <form method="POST" action="{{ route('incident.update', $incident->id) }}" class="was-validated">
                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="category_id" class="col-md-2">Category</label>
                    <select name="category_id" class="form-control col-md-3">
                        <option value="">General</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if ($incident->category_id == $category->id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label for="severity" class="col-md-2">Severity</label>
                    <select name="severity" class="form-control col-md-3">
                        <option value="l" @if ($incident->severity == 'l') selected @endif> Low </option>
                        <option value="n" @if ($incident->severity == 'n') selected @endif> Normal </option>
                        <option value="h" @if ($incident->severity == 'h') selected @endif> High </option>
                    </select>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-2">Title</label>
                    <input type="text" class="form-control col-md-5" name="title" placeholder="title" value="{{ old('title', $incident->title) }}" required>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-2">Description</label>
                    <textarea class="form-control col-md-5" placeholder="Description" name="description" required>{{ old('description', $incident->description) }}</textarea>
                </div>

                <div class="form-group row">
                    <button class="btn btn-outline-success btn-pill">Update Incident</button>
                </div>

            </form>
        </div>
    </div>

@endsection