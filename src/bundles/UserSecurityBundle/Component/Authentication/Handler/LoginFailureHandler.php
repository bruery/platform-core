<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace  Bruery\UserSecurityBundle\Component\Authentication\Handler;

use Bruery\UserSecurityBundle\Component\Authentication\Tracker\LoginFailureTracker;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;

/**
 *
 * @category CCDNUser
 * @package  SecurityBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserSecurityBundle
 *
 */
class LoginFailureHandler extends DefaultAuthenticationFailureHandler
{
    /**
     *
     * @access protected
     * @var \CCDNUser\SecurityBundle\Component\Authentication\Tracker\LoginFailureTracker $loginFailureTracker
     */
    protected $loginFailureTracker;

    /**
     *
     * @access public
     * @param \CCDNUser\SecurityBundle\Component\Authentication\Tracker\LoginFailureTracker $loginFailureTracker
     */
    public function setLoginFailureTracker(LoginFailureTracker $loginFailureTracker)
    {
        $this->loginFailureTracker = $loginFailureTracker;
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\HttpFoundation\Request                                                     $request
     * @param  \Symfony\Component\Security\Core\Exception\AuthenticationException                            $exception
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // Get the visitors IP address and attempted username.
        $ipAddress = $request->getClientIp();
        if ($request->request->has('_username')) {
            $username = $request->request->get('_username');
        } else {
            $username = '';
        }

        // Make a note of the failed login.
        $this->loginFailureTracker->addAttempt($ipAddress, $username);

        // Let Symfony decide what to do next
        return parent::onAuthenticationFailure($request, $exception);
    }
}
