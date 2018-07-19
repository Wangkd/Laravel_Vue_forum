@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>
                        Create a Post
                    </h4>
                </div>

                <div class="card-body">
                    <form action="/threads" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="channel_id">Channel</label>
                            <select class="form-control" name="channel_id" id="channel_id" required>
                                <option value="">Choose a Channel</option>
                                @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old( 'channel_id')==$channel->id ? seleted : ""}}> {{ $channel->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea rows="5" class="form-control" name="body" required>{{ old('body') }}</textarea>
                        </div>
                        @include('particals.errors')


                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
