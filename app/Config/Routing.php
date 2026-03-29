<?php

namespace Config;

use CodeIgniter\Config\Routing as BaseRouting;

class Routing extends BaseRouting
{
    /**
     * For Defined Routes.
     * If auto-routing is not enabled, then the 404 Override class/method
     * that should be called if the requested controller/method is not found.
     */
    public ?string $override404 = null;

    /**
     * If TRUE, the system will attempt to match the URI against
     * Controllers by matching each segment against folders/files
     * in APPPATH/Controllers, when a match wasn't found against
     * defined routes.
     *
     * If FALSE, no auto-routing occurs.
     */
    public bool $autoRoute = false;

    /**
     * If TRUE, will enable the translate URI dashes feature.
     */
    public bool $translateURIDashes = false;
}
