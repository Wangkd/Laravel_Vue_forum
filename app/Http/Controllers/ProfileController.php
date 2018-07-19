<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index(User $profileUser) {
        return view('profiles.index', [
            'profileUser' => $profileUser,
            'activities' => \App\Activity::feed($profileUser)
        ]);
    }
}
