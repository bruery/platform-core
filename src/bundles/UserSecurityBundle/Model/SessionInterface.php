<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\UserSecurityBundle\Model;

interface SessionInterface
{
    /**
     * Set ipAddress
     *
     * @param  string                                  $ipAddress
     * @return \Bruery\UserSecurityBundle\Entity\Session
     */
    public function setIpAddress($ipAddress);

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress();

    /**
     * Set loginAttemptDate
     *
     * @param  integer                                 $loginAttemptDate
     * @return \Bruery\UserSecurityBundle\Entity\Session
     */
    public function setLoginAttemptDate($loginAttemptDate);

    /**
     * Get loginAttemptDate
     *
     * @return integer
     */
    public function getLoginAttemptDate();

    /**
     * Set loginUsername
     *
     * @param  string                                  $loginUsername
     * @return \Bruery\UserSecurityBundle\Entity\Session
     */
    public function setLoginAttemptUsername($loginAttemptUsername);

    /**
     * Get loginUsername
     *
     * @return string
     */
    public function getLoginAttemptUsername();
}
