<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\UserSecurityBundle\Component\Authorisation\Voter;

use Bruery\UserSecurityBundle\Component\Authorisation\SecurityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class ClientLoginVoter implements VoterInterface
{
    /**
     *
     * @access protected
     * @var \Bruery\UserSecurityBundle\Component\Authorisation\SecurityManagerInterface $securityManager
     */
    protected $securityManager;

    /**
     *
     * @access public
     * @param \Bruery\UserSecurityBundle\Component\Authorisation\SecurityManagerInterface $securityManager
     */
    public function __construct(SecurityManagerInterface $securityManager)
    {
        $this->securityManager = $securityManager;
    }

    /**
     *
     * @access public
     * @param $attribute
     * @return bool
     */
    public function supportsAttribute($attribute)
    {
        // we won't check against a user attribute, so we return true
        return true;
    }

    /**
     *
     * @access public
     * @param $class
     * @return bool
     */
    public function supportsClass($class)
    {
        // our voter supports all type of token classes, so we return true
        return true;
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     * @param  object                                                               $object
     * @param  array                                                                $attributes
     * @return int
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $securityManager = $this->securityManager; // Avoid the silly cryptic error 'T_PAAMAYIM_NEKUDOTAYIM'
        $result = $securityManager->vote();

        if ($result == $securityManager::ACCESS_ALLOWED) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        if ($result == $securityManager::ACCESS_DENIED_DEFER) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        if ($result == $securityManager::ACCESS_DENIED_BLOCK) {
            return VoterInterface::ACCESS_DENIED;
        }
    }
}
