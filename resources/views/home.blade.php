@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <h2>Hello {{ auth()->user()->name }}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @isset($hobbies)
                        @if($hobbies->count() > 0)
                        <h3>Your Hobbies:</h3>
                        @endif
                    <ul class="list-group">
                        @foreach($hobbies as $hobby)
                            <li class="list-group-item">
                                <a title="Show Details" href="/hobby/{{ $hobby->id }}">{{ $hobby->name }}</a>
                                @auth
                                    <a class="btn btn-sm btn-light ml-2" href="/hobby/{{ $hobby->id }}/edit"><i class="fas fa-edit"></i> Edit Hobby</a>
                                @endauth

                                @auth
                                    <form class="float-right" style="display: inline" action="/hobby/{{ $hobby->id }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                                    </form>
                                @endauth
                                <span class="float-right mx-2">{{ $hobby->created_at->diffForHumans() }}</span>
                                <br>
                                @foreach($hobby->tags as $tag)
                                    <a href="/hobby/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                    @endisset

                    <a class="btn btn-success btn-sm" href="/hobby/create"><i class="fas fa-plus-circle"></i> Create new Hobby</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
