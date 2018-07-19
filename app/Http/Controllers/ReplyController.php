<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;
use App\Channel;
use App\Reply;

class ReplyController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index']);
    }

    public function index($channel, Thread $thread) {
        return $thread->replies()->paginate(10);
    }
    
    public function store(Request $request, $channel, Thread $thread)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        
        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return $reply->load('owner');
    }

    public function destroy(Reply $reply) {
        // $this->authorize('update', $reply);
        $reply->delete();
    }

    public function update(Reply $reply) {
        // $this->authorize('update', $reply);
        $reply->update([
            'body' => request('body')
        ]);
    }
}
