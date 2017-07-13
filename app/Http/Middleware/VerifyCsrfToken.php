<?php

<<<<<<< HEAD
namespace abisa\Http\Middleware;
=======
namespace App\Http\Middleware;
>>>>>>> branch 'develop' of https://github.com/israellomedic/lomedic

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
