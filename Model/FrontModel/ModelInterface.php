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

use Bruery\UserSecurityBundle\Model\Component\Manager\ManagerInterface;
use Bruery\UserSecurityBundle\Model\Component\Repository\RepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface ModelInterface
{
    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface             $dispatcher
     * @param \Bruery\UserSecurityBundle\Model\Component\Repository\RepositoryInterface $repository
     * @param \Bruery\UserSecurityBundle\Model\Component\Manager\ManagerInterface       $manager
     */
    public function __construct(EventDispatcherInterface $dispatcher, RepositoryInterface $repository, ManagerInterface $manager);

    /**
     *
     * @access public
     * @return \Bruery\UserSecurityBundle\Model\Component\Repository\RepositoryInterface
     */
    public function getRepository();

    /**
     *
     * @access public
     * @return \Bruery\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function getManager();
}
