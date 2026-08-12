<?php

namespace App\Models;

use Laravel\Passport\Client as BaseClient;

class PassportClient extends BaseClient
{
    /**
     * Determine if the client should skip the authorization prompt.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $scopes
     * @return bool
     */
    public function skipsAuthorization(\Illuminate\Contracts\Auth\Authenticatable $user, array $scopes = []): bool
    {
        return true;
    }
}
