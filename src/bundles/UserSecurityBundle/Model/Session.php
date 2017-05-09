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

class Session implements SessionInterface
{
    /**
     *
     * @var string $ipAddress
     */
    protected $ipAddress;

    /**
     *
     * @var \Datetime $loginAttemptDate
     */
    protected $loginAttemptDate;

    /**
     *
     * @var string $loginAttemptUsername
     */
    protected $loginAttemptUsername;

    /**
     * Set ipAddress
     *
     * @param  string                                  $ipAddress
     * @return \Bruery\UserSecurityBundle\Entity\Session
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set loginAttemptDate
     *
     * @param  integer                                 $loginAttemptDate
     * @return \Bruery\UserSecurityBundle\Entity\Session
     */
    public function setLoginAttemptDate($loginAttemptDate)
    {
        $this->loginAttemptDate = $loginAttemptDate;

        return $this;
    }

    /**
     * Get loginAttemptDate
     *
     * @return integer
     */
    public function getLoginAttemptDate()
    {
        return $this->loginAttemptDate;
    }

    /**
     * Set loginUsername
     *
     * @param  string                                  $loginUsername
     * @return \Bruery\UserSecurityBundle\Entity\Session
     */
    public function setLoginAttemptUsername($loginAttemptUsername)
    {
        $this->loginAttemptUsername = $loginAttemptUsername;

        return $this;
    }

    /**
     * Get loginUsername
     *
     * @return string
     */
    public function getLoginAttemptUsername()
    {
        return $this->loginAttemptUsername;
    }
}
