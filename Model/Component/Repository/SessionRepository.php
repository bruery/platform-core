<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\UserSecurityBundle\Model\Component\Repository;

class SessionRepository extends BaseRepository implements RepositoryInterface
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
        $qb = $this->createSelectQuery(array('s'));

        $params = array('1' => $ipAddress, '2' => $timeLimit);

        $qb
            ->where(
                $qb->expr()->andx(
                    $qb->expr()->eq('s.ipAddress', '?1'),
                    $qb->expr()->gt('s.loginAttemptDate', '?2')
                )
            )
        ;

        return $this->gateway->findSessions($qb, $params);
    }
}
