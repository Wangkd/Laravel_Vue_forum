<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilter;

class ThreadController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    
    public function index(Channel $channel, ThreadFilter $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        // return $threads;
        
        return view('thread.index', compact('threads'));
    }
    
    public function create()
    {
        return view('thread.create');
    }

    public function destroy($channel, Thread $thread) {
        $this->authorize('update', $thread);
        $thread->delete();
        return redirect('/threads');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'title' => 'required', 
            'channel_id' => 'required|exists:channels,id'
        ]);
        $thread = Thread::create([
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => request('channel_id'),
            'user_id' => auth()->id(),
        ]);
            
        $thread->save();
        // return $thread;   
        return redirect($thread->path())
                ->with('flash', 'Your thread has been created');
    }
        
    public function show($channelId, Thread $thread)
    {
        // return $thread->replies;
        $replies = $thread->replies()->paginate(10);
        return view('thread.show', [
            'thread' => $thread,
            'replies' => $replies
        ]);
    }
            
    public function getThreads($channel, $filters) {
        $threads = Thread::latest()->with('channel');
        if($channel->exists) {
            $threads = $threads->where('channel_id', $channel->id);
        }
        return $threads->filter($filters)->get();
    }
                
}
            