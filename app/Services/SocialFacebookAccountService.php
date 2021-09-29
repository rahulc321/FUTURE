<?php

namespace App\Services;
use App\SocialFacebookAccount;
use App\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email'    => $providerUser->getEmail(),
                    'username'     => $providerUser->getName(),
                    'password' => md5(rand(1,10000)),
                    'image'    => $providerUser->getAvatar(),
                    'role_id'  => '3',
                    'public_profile' => Str::slug($providerUser->getName()).'-'.substr(md5(rand()), 0, 11)
                ]);
            }
            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}