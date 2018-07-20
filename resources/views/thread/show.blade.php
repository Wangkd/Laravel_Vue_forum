@extends('layouts.app') 
    @section('content')
<thread-view :initial-replies-count='{{ $thread->replies_count }}' inline-template>

        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h4>{{ $thread->title}}</h4>
                            @can ('update', $thread)
                                <span class="float-right">
                                    <form action="{{ $thread->path() }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link">Delete</button>
                                    </form>
                                </span>
                            @endcan
                            posted by <a href="/profiles/{{ $thread->owner->name }}">{{ $thread->owner->name }}</a>
                        </div>
                        <div class="card-body">
                            <p>{{ $thread->body }}</p>
                        </div>
                    </div>

                    <replies 
                            @removed='repliesCount--'
                            @added='repliesCount++'>
                    </replies>
                </div>

                {{-- sidebar --}}
                <div class="col-md-4 ml-auto">
                    <div class="card mb-5">
                        <div class="card-body">
                            <p>
                                This post is posted at <i>{{$thread->created_at->DiffForHumans()}}</i> 
                                by <a href="#">{{ $thread->owner->name}}</a>,
                                currently has <span v-text='repliesCount'></span> {{ str_plural('comment', $thread->replies_count) }}.
                            </p>

                        <subscription-button :subscribed = {{$thread->isSubscribed ? 'true' : 'false'}}></subscription-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection
