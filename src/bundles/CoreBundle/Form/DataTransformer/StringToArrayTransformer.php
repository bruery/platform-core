<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\CoreBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class StringToArrayTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($string)
    {
        if (is_array($string)) {
            return $string;
        }

        return explode(',', $string);

    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($array)
    {
        if (null === $array || !is_array($array)) {
            return '';
        }

        return implode(',', $array);
    }
}
