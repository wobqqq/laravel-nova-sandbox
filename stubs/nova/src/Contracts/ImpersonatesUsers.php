<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;

interface ImpersonatesUsers
{
    /**
     * @return bool
     */
    public function impersonate(\Illuminate\Http\Request $request, \Illuminate\Contracts\Auth\StatefulGuard $guard, \Illuminate\Contracts\Auth\Authenticatable $user);
    /**
     * @return bool
     */
    public function stopImpersonating(\Illuminate\Http\Request $request, \Illuminate\Contracts\Auth\StatefulGuard $guard, string $userModel);
    /**
     * @return bool
     */
    public function impersonating(\Illuminate\Http\Request $request);
    /**
     * @return void
     */
    public function flushImpersonationData(\Illuminate\Http\Request $request);
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectAfterStartingImpersonation(\Illuminate\Http\Request $request);
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectAfterStoppingImpersonation(\Illuminate\Http\Request $request);
}
