<?php
/**
 * This file is part of the Mosaic Platform.
 *
 * (c) Rommel M. Zamora <rommel.zamora@groupm.com>
 * (c) Andrew Aculana <andrew.aculana@movent.com>
 *
 * Copyright (c)  2017. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\CoreBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class ArrayToStringTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($array)
    {
        if (null === $array || !is_array($array)) {
            return '';
        }

        return implode(',', $array);
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($string)
    {
        if (is_array($string)) {
            return $string;
        }

        return explode(',', $string);

    }
}
