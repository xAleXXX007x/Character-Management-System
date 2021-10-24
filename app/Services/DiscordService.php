<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class DiscordService
{
    public function getUserData($code)
    {
        $accessData = Cache::remember('accessData'.$code, 604800, function() use($code) {
            return $this->getAccessToken($code);
        });

        $token = $accessData['access_token'];

        $userData = Cache::remember('userData'.$token, 604800, function() use($token) {
            $curl = curl_init('https://discordapp.com/api/users/@me');

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer '.$token
            ]);
            
            curl_close($curl);
    
            return json_decode(curl_exec($curl), true);
        });

        return $userData;
    }

    public function getAccessToken($code)
    {
        $curl = curl_init(config('services.discord.api').'/oauth2/token');

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, [
            'client_id' => config('services.discord.clientid'),
            'client_secret' => config('services.discord.secret'),
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => config('services.discord.redirecturi')
        ]);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);

        $data = json_decode(curl_exec($curl), true);

        return $data;
    }
}