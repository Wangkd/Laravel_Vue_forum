@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @forelse ($threads as $thread)
            <div class="card mb-3">
                <div class="card-header">
                    <h4>
                        <a href="{{ $thread->path() }}">
                            @if ($thread->hasUpdatesFor(auth()->user()))
                                <strong>{{ $thread->title }}</strong>
                            @else
                                {{ $thread->title }}
                            @endif
                        </a>
                        <p class="float-right text-muted">{{ $thread->created_at->DiffForHumans() }}</p>
                    </h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}</h6>
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            @empty
            The channnel is currently empty.
            @endforelse
        </div>
    </div>
</div>
@endsection
