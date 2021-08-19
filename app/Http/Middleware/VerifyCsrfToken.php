<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://localhost:8000/create_user',
        'http://localhost:8000/create_post/*',
        'http://localhost:8000/write_comment/*',
        'http://localhost:8000/get_posts/*',
        'http://localhost:8000/get_comments/*',
        'http://localhost:8000/get_users',

    ];
}
