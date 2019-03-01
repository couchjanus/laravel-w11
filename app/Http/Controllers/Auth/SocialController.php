<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use App\Social;
use App\User;
use Auth;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{
    public function redirect($provider)
    {
        $providerKey = Config::get('services.'.$provider);

        if (empty($providerKey)) {

            return redirect('/login')
            ->withError('No such provider yet');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUserObject = Socialite::driver($provider)->stateless()->user();
            // dd($socialUserObject);
            $socialUser = null;
            // Check if email is already registered
            $userCheck = User::where(['email' => $socialUserObject->getEmail()])->first();

            $email = $socialUserObject->email;

            if (!$socialUserObject->email) {
                $email = 'missing'.str_random(10).'@'.str_random(10).'.example.org';
            }

            // dd($email);
            
            if (empty($userCheck)) {
                $socialId = Social::where('social_id', '=', $socialUserObject->id)
                ->where('provider', '=', $provider)
                ->first();
                
                if (empty($socialId)) {

                    $socialData = new Social();
                    $profile = new Profile();
                    $fullname = explode(' ', $socialUserObject->getName());
                    if (count($fullname) == 1) {
                        $fullname[1] = 'Nicname';
                    }
                    $profile->first_name = $fullname[0];
                    $profile->last_name = $fullname[1];
                    // Twitter User Object details: https://developer.twitter.com/en/docs/tweets/data-dictionary/overview/user-object
                    if ($provider == 'twitter') {
                        $username = $socialUserObject->getScreen_name();
                    } else {
                        $username = $socialUserObject->getNickname();
                    }

                    if ($username == null) {
                        foreach ($fullname as $name) {
                            $username .= $name;
                        }
                    }
                    $profile->username = $username;
                    $profile->avatar = $socialUserObject->getAvatar();

                    if (!$socialUserObject->getEmail()) {
                        $email = 'missing'.str_random(10).'@'.str_random(10).'.example.org';
                    } else {
                        $email = $socialUserObject->getEmail();
                    }
                    // dd($email);

                    // Check to make sure username does not already exist in DB before recording
                    $username = $this->checkUserName($username, $email);


                    $user = User::create(
                        [
                        'name'                 => $username,
                        'email'                => $email,
                        'password'             => bcrypt(str_random(40)),
                        // 'token'                => str_random(64),
                        // 'activated'            => true,
                        // 'verified'             => true,
                        ]
                    );

                    $socialData->social_id = $socialUserObject->id;
                    $socialData->provider = $provider;
                    $user->social()->save($socialData);

                    $user->profile()->save($profile);
                    $user->save();

                    $user->profile->save();

                    $socialUser = $user;
                } else {
                    $socialUser = $socialId->user;
                }
            // dd($profile);    
            // dd($socialData);    
                auth()->login($socialUser, true);

                return redirect('home')->with('success', 'You have successfully registered! ');
            }
            $socialUser = $userCheck;

            auth()->login($socialUser, true);

            return redirect('home');

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e);
        }
        // dd($profile);
    }

    /**
     * Generate Username.
     *
     * @param string $username
     *
     * @return string
     */
    public function generateUserName($username)
    {
        return $username.'_'.str_random(10);
    }

    /**
     * Check if username against database and return valid username.
     * If username is not in the DB return the username
     * else generate, check, and return the username.
     *
     * @param string $username
     * @param string $email
     *
     * @return string
     */
    public function checkUserName($username, $email)
    {
        $userNameCheck = User::where('name', '=', $username)->first();

        if ($userNameCheck) {
            $i = 1;
            do {
                $username = $this->generateUserName($username);
                $newCheck = User::where('name', '=', $username)->first();

                if ($newCheck == null) {
                    $newCheck = 0;
                } else {
                    $newCheck = count($newCheck);
                }
            } while ($newCheck != 0);
        }

        return $username;
    }
}
