@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-2">
                <div class="card">
                    <div class="card-header font-weight-bold">{{ $thread->title }}</div>

                    <div class="card-body">
                        <section>{{ $thread->body }}</section>
                    </div>

                    <div class="card-footer text-right">
                        <a href="#">{{ $thread->creator->name }}</a>
                        {{ $thread->created_at->toCookieString() }}
                    </div>
                </div>
            </div>
        </div>

        <hr class="col-md-8">

        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    @include('threads.partials.__reply')
                @endforeach
            </div>
        </div>
    </div>
@endsection
