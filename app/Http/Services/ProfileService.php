<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

class ProfileService
{
    /**
     * Updates User Contact Information
     *
     * @param array $data
     */
    public function updateInformation(array $data)
    {
        Auth::user()->name = $data['name'];
        Auth::user()->email = $data['email'];
        Auth::user()->profile->first_name = $data['first_name'];
        Auth::user()->profile->last_name = $data['last_name'];
        Auth::user()->profile->location = $data['location'];
        Auth::user()->profile->bio = $data['bio'];
        Auth::user()->profile->save();
        Auth::user()->save();
    }

    /**
     * Updates user password
     *
     * @param string $password
     */
    public function updatePassword(string $password)
    {
        Auth::user()->password = bcrypt($password);
        Auth::user()->save();
    }

}