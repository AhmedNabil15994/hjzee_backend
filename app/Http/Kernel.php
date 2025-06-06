<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {
  /**
   * The application's global HTTP middleware stack.
   *
   * These middleware are run during every request to your application.
   *
   * @var array
   */
  protected $middleware = [
    // \App\Http\Middleware\TrustHosts::class,
    \App\Http\Middleware\TrustProxies::class,
    \Fruitcake\Cors\HandleCors::class,
    \App\Http\Middleware\CheckForMaintenanceMode::class,
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    \App\Http\Middleware\TrimStrings::class,
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
  ];

  /**
   * The application's route middleware groups.
   *
   * @var array
   */
  protected $middlewareGroups = [
    'web' => [
      \App\Http\Middleware\EncryptCookies::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\Session\Middleware\StartSession::class,
      \App\Http\Middleware\SiteLang::class,
      // \Illuminate\Session\Middleware\AuthenticateSession::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      \App\Http\Middleware\VerifyCsrfToken::class,
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => [
      'throttle:60,1',
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
  ];

  /**
   * The application's route middleware.
   *
   * These middleware may be assigned to groups or used individually.
   *
   * @var array
   */
  protected $routeMiddleware = [
    'auth'                              => \App\Http\Middleware\Authenticate::class,
    'auth.basic'                        => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings'                          => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'cache.headers'                     => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can'                               => \Illuminate\Auth\Middleware\Authorize::class,
    'guest'                             => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'password.confirm'                  => \Illuminate\Auth\Middleware\RequirePassword::class,
    'signed'                            => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle'                          => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified'                          => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'HtmlMinifier'                      => \App\Http\Middleware\HtmlMifier::class,
    'is-active'                         => \App\Http\Middleware\CheckAuthStatus::class,

    'admin'                             => \App\Http\Middleware\Admin\AdminMiddleware::class,
    'check-role'                        => \App\Http\Middleware\Admin\CheckRoleMiddleware::class,
    'admin-lang'                        => \App\Http\Middleware\Admin\AdminLang::class,
    'web-cors'                          => \App\Http\Middleware\WebCors::class,

    'api-lang'                          => \App\Http\Middleware\Api\ApiLang::class,
    'api-cors'                          => \App\Http\Middleware\Api\ApiCors::class,
    'OptionalSanctumMiddleware'         => \App\Http\Middleware\Api\OptionalSanctumMiddleware::class,
    'lang'                              => \App\Http\Middleware\SiteLang::class,
    'provider-auth'                     => \App\Http\Middleware\CheckProviderAuth::class,
    'CheckProviderRole'                 => \App\Http\Middleware\CheckProviderRole::class,

  ];
}
