<?php

namespace Perspikapps\LaravelEnvRibbon;


use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use AvtoDev\AppVersion\AppVersionManager;

class LaravelEnvRibbon
{
    /**
     * The Laravel application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * True when enabled, false disabled an null for still unknown
     *
     * @var bool
     */
    protected $enabled = null;

    protected $appversion = null;

    protected $appenvironment = null;

    protected $color = null;

    protected $visible = null;

    /**
     * @param Application $app
     */
    public function __construct($app = null, AppVersionManager $appversion)
    {
        if (!$app) {
            $app = app();   //Fallback when $app is not given
        }

        $this->app = $app;
        $this->version = $app->version();
        $this->is_lumen = Str::contains($this->version, 'Lumen');
        $this->appversion = $appversion;

        $this->loadConfig();
    }

    /**
     * Enable the ribbon and boot, if not already booted.
     */
    public function enable()
    {
        $this->enabled = true;
    }

    /**
     * Modify the response and inject the ribbon (or data in headers)
     *
     * @param  \Symfony\Component\HttpFoundation\Request $request
     * @param  \Symfony\Component\HttpFoundation\Response $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function modifyResponse(Request $request, Response $response)
    {
        $app = $this->app;
        if (!$this->isEnabled() || !$this->visible) {
            return $response;
        }

        $content = $response->getContent();

        if (($head = mb_strpos($content, '</head>')) !== false) {
            $content = mb_substr($content, 0, $head) .
                '<style>'
                . file_get_contents(__DIR__ . '/../resources/laravel-env-ribbon.css') .
                '</style>' .
                mb_substr($content, $head);
        }

        if (($body = mb_strpos($content, '</body>')) !== false) {
            $content = mb_substr($content, 0, $body) .
                '<div class="laravel-env-ribbon" style="--ribbon-color : ' . $this->color . ';">
                    <a href="#">' . $this->app->environment() . ' ' .   $this->appversion->version() . '</a>
                </div>' .
                mb_substr($content, $body);
        }

        $response->setContent($content);
    }

    /**
     * Check if the ribbon is enabled
     * @return boolean
     */
    public function isEnabled()
    {
        if ($this->enabled === null) {
            $config = $this->app['config'];
            $configEnabled = value($config->get('laravel-env-ribbon.enabled'));

            $this->enabled = $configEnabled && !$this->app->runningInConsole();
        }

        return $this->enabled;
    }


    /**
     * Check if the ribbon is enabled
     * @return boolean
     */
    public function loadConfig()
    {
        $current = $this->app->environment();

        $config = $this->app['config'];
        $environments = value($config->get('laravel-env-ribbon.environments'));

        $index = key_exists($current, $environments) ? $current : '*';

        if (key_exists($index, $environments)) {
            $this->color = $environments[$index]['color'] ?? 'black';
            $this->visible = $environments[$index]['visible'] ?? true;
        }
    }
}
