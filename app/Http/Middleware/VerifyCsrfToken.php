<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'http://127.0.0.1:8000/name-etap',
        'http://127.0.0.1:8000/date-etap',
        'http://127.0.0.1:8000/map-etap',
        'http://127.0.0.1:8000/phone-etap',
        'http://127.0.0.1:8000/code-etap',
        'http://127.0.0.1:8000/parol-etap',
    ];
}
