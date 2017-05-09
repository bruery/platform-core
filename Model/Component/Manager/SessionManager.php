<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\UserSecurityBundle\Model\Component\Manager;

class SessionManager extends BaseManager implements ManagerInterface
{
    /**
     *
     * @access public
     * @param  string                                                          $ipAddress
     * @param  string                                                          $username
     * @return \Bruery\UserSecurityBundle\Model\Component\Manager\SessionManager
     */
    public function newRecord($ipAddress, $username)
    {
        $session = $this->create();

        $session->setIpAddress($ipAddress);
        $session->setLoginAttemptUsername($username);
        $session->setLoginAttemptDate(new \DateTime('now'));

        $this
            ->persist($session)
            ->flush()
        ;

        return $this;
    }
}
