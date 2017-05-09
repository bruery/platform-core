<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\UserSecurityBundle\Model\Component\Gateway;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\QueryBuilder;

interface GatewayInterface
{
    /**
     *
     * @access public
     * @param \Doctrine\Common\Persistence\ObjectManager $em
     * @param string                                     $entityClass
     */
    public function __construct(ObjectManager $em, $entityClass);

    /**
     *
     * @access public
     * @return string
     */
    public function getEntityClass();

    /**
     *
     * @access public
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder();

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function one(QueryBuilder $qb, $parameters = array());

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function all(QueryBuilder $qb, $parameters = array());

    /**
     *
     * @access public
     * @param  Object                                                $entity
     * @return \Bruery\UserSecurityBundle\Gateway\BaseGatewayInterface
     */
    public function persist($entity);

    /**
     *
     * @access public
     * @param  Object                                                $entity
     * @return \Bruery\UserSecurityBundle\Gateway\BaseGatewayInterface
     */
    public function remove($entity);

    /**
     *
     * @access public
     * @return \Bruery\UserSecurityBundle\Gateway\BaseGatewayInterface
     */
    public function flush();

    /**
     *
     * @access public
     * @param  Object                                                $entity
     * @return \Bruery\UserSecurityBundle\Gateway\BaseGatewayInterface
     */
    public function refresh($entity);
}
