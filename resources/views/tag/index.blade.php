
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Tags</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($tags as $tag)
                                <li class="list-group-item">
                                    <span style="font-size: 130%;" class="mr-2 badge badge-{{ $tag->style }}">{{ $tag->name }}</span>
                                    @can('update', $tag)
                                    <a class="ml-2 btn btn-sm btn-outline-primary" href="/tag/{{ $tag->id }}/edit"><i class="fas fa-edit"></i> Edit</a>
                                    @endcan

                                    @can('delete', $tag)
                                        <form style="display: inline;" action="/tag/{{ $tag->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-outline-danger btn-sm ml-2" type="submit" value="Delete">
                                        </form>
                                    @endcan
                                    <a class="float-right" href="/hobby/tag/{{ $tag->id }}">Used {{ $tag->hobbies->count() }} times</a>
                                </li>
                            @endforeach
                        </ul>
                        @can('create', $tag)
                            <a class="btn btn-success btn-sm mt-3" href="/tag/create"><i class="fas fa-plus-circle"></i> New Tag</a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

