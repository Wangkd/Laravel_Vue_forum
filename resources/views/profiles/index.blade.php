@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="page-header mb-5 border-bottom">
                <h1>
                    {{ $profileUser->name }}
                </h1>
                <h5 class="text-muted">created {{ $profileUser->created_at->DiffForHumans() }}</h5>
            </div>

            @forelse ($activities as $date => $records)
            <h3 class="border-bottom mb-3">{{ $date }}</h3>
                @foreach ($records as $activity)
                    @include("profiles.activities.{$activity->type}")
                @endforeach
            @empty
                <p>There are no activities for this user yet.</p>
            @endforelse

        </div>

    </div>
</div>
@endsection
