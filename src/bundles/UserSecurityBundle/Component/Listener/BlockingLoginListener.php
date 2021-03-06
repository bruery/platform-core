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

use Bruery\UserSecurityBundle\Component\Authorisation\SecurityManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

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
class BlockingLoginListener
{
    /**
     *
     * @access protected
     * @var \Bruery\UserSecurityBundle\Component\Authorisation\SecurityManagerInterface $securityManager
     */
    protected $securityManager;

    /**
     * @var AccessDeniedExceptionFactoryInterface
     */
    protected $exceptionFactory;

    /**
     *
     * @access public
     * @param \Bruery\UserSecurityBundle\Component\Authorisation\SecurityManagerInterface         $securityManager
     * @param \Bruery\UserSecurityBundle\Component\Listener\AccessDeniedExceptionFactoryInterface $exceptionFactory
     */
    public function __construct(SecurityManagerInterface $securityManager, AccessDeniedExceptionFactoryInterface $exceptionFactory)
    {
        $this->securityManager = $securityManager;
        $this->exceptionFactory = $exceptionFactory;
    }

    /**
     *
     * If you have failed to login too many times,
     * a log of this will be present in the databse.
     *
     * @access public
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequestType() !== \Symfony\Component\HttpKernel\HttpKernel::MASTER_REQUEST) {
            return;
        }

        $securityManager = $this->securityManager; // Avoid the silly cryptic error 'T_PAAMAYIM_NEKUDOTAYIM'
        $result = $securityManager->vote();

        if ($result == $securityManager::ACCESS_ALLOWED) {
            return;
        }

        if ($result == $securityManager::ACCESS_DENIED_BLOCK) {
            $event->stopPropagation();

            throw $this->exceptionFactory->createAccessDeniedException();
        }
    }
}
