<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;

class RecentlyCreatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $original = $response->getOriginalContent();

        // If the response original content is a Eloquent Model and its
        // recently created, the response HTTP status code should be changed to
        // "201 Created" to keep REST standard

        if ($original instanceof Model && $original->wasRecentlyCreated) {
            $response->setStatusCode(201);
        }

        return $response;
    }
}
