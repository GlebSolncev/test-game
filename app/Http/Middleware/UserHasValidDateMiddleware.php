<?php

namespace App\Http\Middleware;

use App\Services\LinkService;
use Closure;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class UserHasValidDateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var LinkService $linkService */
        $linkService = Container::getInstance()->make(LinkService::class);
        $link = $linkService->getBySlug($request->slug);
        if(Carbon::now() > $link->verified_at)
            throw new AccessDeniedException("Your access has been deactivated");

        return $next($request);
    }
}
