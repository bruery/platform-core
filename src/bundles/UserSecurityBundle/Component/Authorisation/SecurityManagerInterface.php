<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\UserSecurityBundle\Component\Authorisation;

use Bruery\UserSecurityBundle\Component\Authentication\Tracker\LoginFailureTracker;
use Symfony\Component\HttpFoundation\RequestStack;

interface SecurityManagerInterface
{
    const ACCESS_ALLOWED = 0;
    const ACCESS_DENIED_DEFER = 1;
    const ACCESS_DENIED_BLOCK = 2;

    /**
     * Constructor
     *
     * @access public
     * @param \Symfony\Component\HttpFoundation\RequestStack                                $requestStack
     * @param \Bruery\UserSecurityBundle\Component\Authentication\Tracker\LoginFailureTracker $loginFailureTracker
     * @param array                                                                         $routeLogin
     * @param array                                                                         $forceAccountRecovery
     * @param array                                                                         $blockPages
     */
    public function __construct(RequestStack $requestStack, LoginFailureTracker $loginFailureTracker, $routeLogin, $forceAccountRecovery, $blockPages);

    /**
     * @access public
     * @return int
     */
    public function vote();
}
