<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\UserSecurityBundle\Model\FrontModel;

class SessionModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @param  string                                       $ipAddress
     * @param  string                                       $timeLimit
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllByIpAddressAndLoginAttemptDate($ipAddress, $timeLimit)
    {
        return $this->getRepository()->findAllByIpAddressAndLoginAttemptDate($ipAddress, $timeLimit);
    }

    /**
     *
     * @access public
     * @param  string                                                 $ipAddress
     * @param  string                                                 $username
     * @return \Bruery\UserSecurityBundle\Model\FrontModel\SessionModel
     */
    public function newRecord($ipAddress, $username)
    {
        return $this->getManager()->newRecord($ipAddress, $username);
    }
}
