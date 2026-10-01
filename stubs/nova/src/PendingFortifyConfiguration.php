<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Closure;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable as FortifyRedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\ConfirmPasswordViewResponse as ConfirmPasswordViewResponseContract;
use Laravel\Fortify\Contracts\FailedPasswordConfirmationResponse as FailedPasswordConfirmationResponseContract;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse as FailedPasswordResetLinkRequestResponseContract;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;
use Laravel\Fortify\Contracts\PasswordConfirmedResponse as PasswordConfirmedResponseContract;
use Laravel\Fortify\Contracts\PasswordUpdateResponse as PasswordUpdateResponseContract;
use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse as RequestPasswordResetLinkViewResponseContract;
use Laravel\Fortify\Contracts\ResetPasswordViewResponse as ResetPasswordViewResponseContract;
use Laravel\Fortify\Contracts\ResetsUserPasswords as ResetsUserPasswordsContract;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse as SuccessfulPasswordResetLinkRequestResponseContract;
use Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse as TwoFactorChallengeViewResponseContract;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;
use Laravel\Fortify\Contracts\UpdatesUserPasswords as UpdatesUserPasswordsContract;
use Laravel\Fortify\Contracts\VerifyEmailViewResponse as VerifyEmailViewResponseContract;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\RedirectAsIntended;
use Laravel\Nova\Auth\Actions\ConfirmPasswordViewResponse;
use Laravel\Nova\Auth\Actions\FailedPasswordConfirmationResponse;
use Laravel\Nova\Auth\Actions\FailedPasswordResetLinkRequestResponse;
use Laravel\Nova\Auth\Actions\LoginResponse;
use Laravel\Nova\Auth\Actions\LoginViewResponse;
use Laravel\Nova\Auth\Actions\PasskeyLoginResponse;
use Laravel\Nova\Auth\Actions\PasswordConfirmedResponse;
use Laravel\Nova\Auth\Actions\PasswordUpdateResponse;
use Laravel\Nova\Auth\Actions\RedirectAsIntendedForNova;
use Laravel\Nova\Auth\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Nova\Auth\Actions\RequestPasswordResetLinkViewResponse;
use Laravel\Nova\Auth\Actions\ResetPasswordViewResponse;
use Laravel\Nova\Auth\Actions\ResetUserPassword;
use Laravel\Nova\Auth\Actions\SuccessfulPasswordResetLinkRequestResponse;
use Laravel\Nova\Auth\Actions\TwoFactorChallengeViewResponse;
use Laravel\Nova\Auth\Actions\TwoFactorLoginResponse;
use Laravel\Nova\Auth\Actions\UpdateUserPassword;
use Laravel\Nova\Auth\Actions\VerifyEmailViewResponse;
use Laravel\Nova\Events\ServingNova;
use Laravel\Passkeys\Contracts\PasskeyLoginResponse as PasskeyLoginResponseContract;

class PendingFortifyConfiguration
{
    /**
     * @var array<int, string>|null
     */
    public ?array $features = null;
    /**
     * @var array<string, mixed>|null
     */
    public ?array $options = null;
    public string $username;
    public string $email;
    protected ?array $cachedConfig = null;
    protected ?array $cachedOptionsConfig = null;
    /**
     * @var (callable(\Illuminate\Http\Request):(array<int, string|class-string>))|null
     */
    protected static $authenticateThroughCallback = null;
    /**
     * @var (callable(\Illuminate\Http\Request):(array<int, string|class-string>))|null
     */
    protected static $originalAuthenticateThroughCallback = null;
    /**
     * @var (callable(\Illuminate\Http\Request):(mixed|null))|null
     */
    protected static $authenticateUsingCallback = null;
    /**
     * @var (callable(\Illuminate\Http\Request):(mixed|null))|null
     */
    protected static $originalAuthenticateUsingCallback = null;
    /**
     * @var (callable(mixed, ?string):(bool))|null
     */
    protected static $confirmPasswordsUsingCallback = null;
    /**
     * @var (callable(mixed, ?string):(bool))|null
     */
    protected static $originalConfirmPasswordsUsingCallback = null;
    protected bool $cached = false;
    protected ?bool $withFrontendRoutes = null;
    public function __construct() {
    }
    /**
     * @param  (\Closure():(array<int, string>|null))|array<int, string>|null  $features
     * @return $this
     */
    public function features(\Closure|array|null $features = null) {
        return $this;
    }
    public function enabled(string $feature): bool {
        return false;
    }
    public function hasSecurityFeatures(): bool {
        return false;
    }
    public function canManageTwoFactorAuthentication(): bool {
        return false;
    }
    /**
     * @return $this
     */
    public function usernameUsing(string $attribute) {
        return $this;
    }
    /**
     * @return $this
     */
    public function emailUsing(string $attribute) {
        return $this;
    }
    /**
     * @param  callable(\Illuminate\Http\Request):(array<int, string|class-string>)  $callback
     * @return $this
     */
    public function authenticateThrough(callable $callback) {
        return $this;
    }
    /**
     * @param  callable(\Illuminate\Http\Request):(mixed|null)  $callback
     * @return $this
     */
    public function authenticateUsing(callable $callback) {
        return $this;
    }
    /**
     * @param  callable(mixed, ?string):bool  $callback
     * @return $this
     */
    public function confirmPasswordsUsing(callable $callback) {
        return $this;
    }
    public function usingIdenticalGuardOrModel(): bool {
        return true;
    }
    public function sync(): void {
    }
    public function flush(): void {
    }
    public function register(?bool $routes = null): void {
    }
    public function bootstrap(): void {
    }
}
