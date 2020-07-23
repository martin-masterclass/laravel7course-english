
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Hobby</div>
                    <div class="card-body">
                        <form autocomplete="off" action="/hobby/{{$hobby->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' border-danger' : '' }}" id="name" name="name" value="{{ old('name') ?? $hobby->name }}">
                                <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                            </div>
                            @if(file_exists('img/hobbies/' . $hobby->id . '_large.jpg'))
                            <div class="mb-2">
                                <img style="max-width: 400px; max-height: 300px;" src="/img/hobbies/{{$hobby->id}}_large.jpg" alt="">
                                <a class="btn btn-outline-danger float-right" href="/delete-images/hobby/{{$hobby->id}}">Delete Image</a>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control{{ $errors->has('image') ? ' border-danger' : '' }}" id="image" name="image" value="">
                                <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control{{ $errors->has('description') ? ' border-danger' : '' }}" id="description" name="description" rows="5">{{old('description') ?? $hobby->description}}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save Hobby">
                        </form>
                        <a class="btn btn-primary float-right" href="/hobby"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection