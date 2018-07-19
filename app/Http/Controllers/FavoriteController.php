<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reply;

class FavoriteController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Reply $reply) {
        $reply->favorited();
        return $reply;
        // return back();
    }

    public function destroy(Reply $reply) {
        $reply->unfavorited();
        // return back();
    }
}
