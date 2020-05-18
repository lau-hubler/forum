@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">{{ $thread->title }}</div>

                    <div class="card-body">
                        <section>{{ $thread->body }}</section>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    <div class="card my-3">
                        <div class="card-header">
                            <a href="#">{{ $reply->owner->name }}</a> said
                            {{ $reply->created_at->diffForHumans() }}
                        </div>
                        <div class="card-body">
                            <div class="body">{{ $reply->body }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
