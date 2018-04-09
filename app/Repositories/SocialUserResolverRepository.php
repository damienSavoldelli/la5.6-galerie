<?php
namespace App\Repositories;

use Adaojunior\Passport\SocialGrantException;
use Adaojunior\Passport\SocialUserResolverInterface;

use App\Models\ {User, socialUser};

class SocialUserResolverRepository implements SocialUserResolverInterface
{
    /**
     * Resolves user by given network and access token.
     *
     * @param string $network
     * @param string $token
     * @param string|null $accessTokenSecret
     * @return mixed
     */
    public function resolve($network, $token, $accessTokenSecret = null)
    {
        switch ($network) {
            case 'facebook':
            case 'google':
                return $this->provider($token, $network);
                break;
            default:
                throw SocialGrantException::invalidNetwork();
                break;
        }
    }

    /**
     * resolve user by provider acces token
     *
     * @param  string $token [description]
     * @return mixed
     */
    public function provider(string $token, string $provider)
    {
        $socialUser = socialUser::where('provider_user_token', $token)->first();

        if (is_null($socialUser->user)) {
            return response()->json([
              "message" => "invalid_credentials",
              "errors" => "The {$provider}'s id of the user does not exist.",
            ], 404);
        }

        return $socialUser->user;
    }
}
