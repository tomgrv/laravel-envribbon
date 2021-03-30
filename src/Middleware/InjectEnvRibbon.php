<?php

namespace Perspikapps\EnvRibbon\Middleware;

use Closure;
use Illuminate\Contracts\Container\Container;
use Perspikapps\EnvRibbon\EnvRibbon;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectEnvRibbon
{
    /**
     * The App container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The DebugBar instance.
     *
     * @var LaravelDebugbar
     */
    protected $envribbon;

    /**
     * Create a new middleware instance.
     */
    public function __construct(Container $container, EnvRibbon $envribbon)
    {
        $this->container = $container;
        $this->envribbon = $envribbon;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     *
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
