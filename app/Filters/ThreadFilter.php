<?php

namespace App\Filters;


class ThreadFilter extends Filter
{
    protected $filters = ['by', 'popular', 'fresh'];
    
    public function by($username) { 

        $user = \App\User::where('name', $username)->firstOrFail();
        
        return $this->builder->where('user_id', $user->id);
    }

    public function popular() {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

    public function fresh() {
        return $this->builder->where('replies_count', 0);
    }
}
