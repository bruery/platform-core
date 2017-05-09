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

use Symfony\Component\HttpKernel\Exception\HttpException;

class AccessDeniedExceptionFactory implements AccessDeniedExceptionFactoryInterface
{
    public function createAccessDeniedException()
    {
        return new HttpException(500, 'flood control - login blocked');
    }
}
