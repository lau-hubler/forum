@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Forum Threads')}}</div>

                    <div class="card-body">
                        @foreach($threads as $thread)
                            <article>
                                <a href="{{ route('threads.show', $thread ) }}">{{ $thread->title }}</a>
                                <div class="body">{{ $thread->body }}</div>
                            </article>

                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
