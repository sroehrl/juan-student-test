<?php

namespace Neoan3\Component\Home;

use Neoan3\Core\Unicore;

/**
 * Class HomeController
 * @package Neoan3\Component\Home
 *
 * Generated by neoan3-cli for neoan3 v3.*
 */

class HomeController extends Unicore{
    /**
     * Route: Home
     */
    function init(): void
    {
        $this
            ->uni('Demo')
            ->hook('main', 'home')
            ->output();
    }

}