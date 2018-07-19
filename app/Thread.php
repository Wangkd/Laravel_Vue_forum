<?php

namespace App;


use App\Reply;
use App\Notifications\ThreadWasUpdated;

class Thread extends Model
{
    use RecordsActivity;

    protected $with = ['owner', 'channel'];

    protected $appends = ['isSubscribed'];

    protected static function boot()
    {
        Parent::boot();

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
        static::created(function ($thread) {
            // $thread->update(['slug' => $thread->title]);
        });
    }



    public function subscribe($userId = null) {
        $this->subscriptions()->create([
            'user_id'=> $userId ?: auth()->id()
        ]);
    }

    public function unSubscribe($userId = null) {
        $this->subscriptions()->where('user_id', $userId ?: auth()->id())->delete();
    }

    public function getIsSubscribedAttribute() {
        return $this->subscriptions()->where('user_id', auth()->id())->exists();
    }

    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function subscriptions() {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function addReply($reply) {
        $reply = $this->replies()->create($reply);
        foreach ($this->subscriptions as $sub) {
            if($sub->user_id != $reply->user_id) {
                $sub->user->notify(new ThreadWasUpdated($this, $reply));
            }
        }

        return $reply;
    }

    public function scopeFilter($query, $filters) {
        return $filters->apply($query);
    }

    public function path() {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }
}
