<?php

<<<<<<< HEAD
namespace abisa\Http\Middleware;
=======
namespace App\Http\Middleware;
>>>>>>> branch 'develop' of https://github.com/israellomedic/lomedic

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
