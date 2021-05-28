<?php

namespace Neoan3\Component\Dashboard;

use Neoan3\Core\Unicore;

/**
 * Class DashboardController
 * @package Neoan3\Component\Dashboard
 *
 * Generated by neoan3-cli for neoan3 v3.*
 */

class DashboardController extends Unicore{
    /**
     * Route: Dashboard
     */
    function init(): void
    {
        $this
            ->uni('Demo')
            ->hook('main', 'dashboard')
            ->output();
    }

}