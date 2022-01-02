<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($profile)
    {
        $data = Profile::where('username', $profile)->first();

        return $data;
        // return Profile::find($profile);
    }
}
