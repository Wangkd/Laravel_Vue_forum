<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;
use App\Channel;
use App\Reply;
use App\Inspections\Spam;

class ReplyController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index']);
    }

    public function index($channel, Thread $thread) {
        return $thread->replies()->paginate(10);
    }
    
    public function store($channel, Thread $thread)
    {
        try {
            $this->validateReply();
        
            $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ]);
        } catch(\Exception $e) {
            return response("Sorry, your reply can't be added", 422);
        }
        
        return $reply->load('owner');
    }

    public function destroy(Reply $reply) {
        // $this->authorize('update', $reply);
        $reply->delete();
    }

    public function update(Reply $reply) {
        // $this->authorize('update', $reply);
        try {
            $this->validateReply();
        
            $reply->update([
                'body' => request('body')
            ]);
        } catch(\Exception $e) {
            return response("Sorry, your reply can't be updated", 422);
        }
    }

    public function validateReply() {
        $this->validate(request(), [
            'body' => 'required'
        ]);

        app(Spam::class)->detect(request('body'));
    }
}
