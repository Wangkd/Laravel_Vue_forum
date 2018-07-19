<?php

namespace App;


trait Favoritable   
{
    protected static function bootFavoritable() {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }
    
    public function favorites() {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function favorited() {
        $attributes = ['user_id' => auth()->id()];

        if(!$this->isFavorited()) {
            return $this->favorites()->create($attributes);
        }
    }

    public function unfavorited() {
        $attributes = ['user_id' => auth()->id()];

        return $this->favorites()->where($attributes)->get()->each->delete();
    }

    public function isFavorited() {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getFavoritesCountAttribute() {
        return $this->favorites->count();
    }

    public function getIsFavoritedAttribute() {
        return $this->isFavorited();
    }
}
