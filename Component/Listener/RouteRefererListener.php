<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\UserSecurityBundle\Component\Listener;

use Bruery\UserSecurityBundle\Component\Listener\RouteRefererListener as BaseRouteRefererListener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RouteRefererListener extends BaseRouteRefererListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        // Abort if we are dealing with some symfony2 internal requests.
        if ($event->getRequestType() !== \Symfony\Component\HttpKernel\HttpKernel::MASTER_REQUEST) {
            return;
        }

        // Get the route from the request object.
        $request = $event->getRequest();
        $route = $request->get('_route');

        if (in_array($route, $this->routeIgnoreList)) {
            return;
        }

        // Check for any internal routes.
        if ($route[0] == '_') {
            return;
        }
        // Get the session and assign it the url we are at presently.
        $session = $request->getSession();
        $session->set('referer', $request->getRequestUri());
    }
}
