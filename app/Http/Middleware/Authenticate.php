<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponseTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use ApiResponseTrait;

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
        if ($request->expectsJson()) {
            return $this->apiResponse('', 'Unauthenticated', false, 401);
        }
    }
}
