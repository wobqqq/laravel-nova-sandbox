<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Nova\Http\Controllers\Fortify\AuthenticatedSessionController;
use Laravel\Nova\Http\Controllers\Fortify\ConfirmablePasswordController;
use Laravel\Nova\Http\Controllers\Fortify\NewPasswordController;
use Laravel\Nova\Http\Controllers\Fortify\PasswordController;
use Laravel\Nova\Http\Controllers\Fortify\PasswordResetLinkController;
use Laravel\Nova\Http\Controllers\Fortify\TwoFactorAuthenticatedSessionController;
use Laravel\Nova\Http\Controllers\Pages\AttachableController;
use Laravel\Nova\Http\Controllers\Pages\AttachedResourceUpdateController;
use Laravel\Nova\Http\Controllers\Pages\DashboardController;
use Laravel\Nova\Http\Controllers\Pages\Error403Controller;
use Laravel\Nova\Http\Controllers\Pages\Error404Controller;
use Laravel\Nova\Http\Controllers\Pages\HomeController;
use Laravel\Nova\Http\Controllers\Pages\LensController;
use Laravel\Nova\Http\Controllers\Pages\ResourceCreateController;
use Laravel\Nova\Http\Controllers\Pages\ResourceDetailController;
use Laravel\Nova\Http\Controllers\Pages\ResourceIndexController;
use Laravel\Nova\Http\Controllers\Pages\ResourceReplicateController;
use Laravel\Nova\Http\Controllers\Pages\ResourceUpdateController;
use Laravel\Nova\Http\Controllers\Pages\UserSecurityController;
use Laravel\Passkeys\Http\Controllers\PasskeyConfirmationController;
use Laravel\Passkeys\Http\Controllers\PasskeyLoginController;
use Laravel\Passkeys\Http\Controllers\PasskeyRegistrationController;
use function Orchestra\Sidekick\package_version_compare;

class PendingRouteRegistration
{
    public string|false $loginPath = false;
    public string|false $logoutPath = false;
    public string|false $forgotPasswordPath = false;
    public string|false $resetPasswordPath = false;
    public bool $withAuthentication = false;
    public bool $withPasswordReset = false;
    public bool $withDefaultAuthentication = false;
    public bool $withEmailVerification = false;
    public bool $withPasswordResetPreventsEmailEnumeration = false;
    /**
     * @var array<int, class-string|string>
     */
    protected $authenticationMiddlewares = ['nova'];
    /**
     * @var array<int, class-string|string>
     */
    protected $passwordResetMiddlewares = ['nova'];
    /**
     * @param  array<int, class-string|string>  $middleware
     * @return $this
     */
    public function withAuthenticationRoutes(array $middleware = ['nova:auth'], bool $default = false) {
        return $this;
    }
    /**
     * @param  array<int, class-string|string>  $middleware
     * @return $this
     */
    public function withoutAuthenticationRoutes(string|false $login = '/login', string|false $logout = '/logout', array $middleware = ['nova:auth']) {
        return $this;
    }
    /**
     * @param  array<int, class-string|string>  $middleware
     * @return $this
     */
    public function withPasswordResetRoutes(array $middleware = ['nova:auth'], bool $preventsEmailEnumeration = false) {
        return $this;
    }
    /**
     * @return $this
     */
    public function withoutPasswordResetRoutes(string|false $forgotPassword = '/forgot-password', string|false $resetPassword = '/reset-password', array $middleware = ['nova:auth']) {
        return $this;
    }
    /**
     * @return $this
     */
    public function withEmailVerificationRoutes() {
        return $this;
    }
    /**
     * @return $this
     */
    public function withoutEmailVerificationRoutes() {
        return $this;
    }
    public function defaultAuthentication(): bool {
        return true;
    }
    /**
     * @return $this
     */
    public function register() {
        return $this;
    }
    public function bootstrap(\Illuminate\Contracts\Foundation\Application $app): void {
    }
    protected function bootstrapAuthenticationRoutes(\Illuminate\Contracts\Foundation\Application $app): void {
    }
    protected function bootstrapPasswordResetRoutes(\Illuminate\Contracts\Foundation\Application $app): void {
    }
    protected function bootstrapEmailVerificationRoutes(\Illuminate\Contracts\Foundation\Application $app): void {
    }
    /**
     * @param  array<int, string|class-string>  $apiMiddlewares
     */
    protected function bootstrapUserSecurityRoutes(\Illuminate\Contracts\Foundation\Application $app, array $apiMiddlewares): void {
    }
    /**
     * @param  array<int, string|class-string>  $apiMiddlewares
     */
    protected function bootstrapConfirmPasswordRoutes(\Illuminate\Contracts\Foundation\Application $app, array $apiMiddlewares): void {
    }
    /**
     * @param  array<int, string|class-string>  $apiMiddlewares
     */
    protected function bootstrapTwoFactorAuthenticationRoutes(\Illuminate\Contracts\Foundation\Application $app, array $apiMiddlewares): void {
    }
}
