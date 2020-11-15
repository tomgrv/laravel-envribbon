<?php

namespace Perspikapps\LaravelEnvRibbon\Middleware;

use Error;
use Closure;
use Exception;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Perspikapps\LaravelEnvRibbon\LaravelEnvRibbon;

class InjectLaravelEnvRibbon
{
    /**
     * The App container
     *
     * @var Container
     */
    protected $container;

    /**
     * The DebugBar instance
     *
     * @var LaravelDebugbar
     */
    protected $envribbon;

    /**
     * Create a new middleware instance.
     *
     * @param  Container $container
     * @param  LaravelEnvRibbon $envribbon
     */
    public function __construct(Container $container, LaravelEnvRibbon $envribbon)
    {
        $this->container = $container;
        $this->envribbon = $envribbon;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!$this->envribbon->isEnabled()) {
            return $next($request);
        }

        // Get Response
        $response = $next($request);

        // Modify the response to add the ribbon
        $this->envribbon->modifyResponse($request, $response);

        return $response;
    }
}
