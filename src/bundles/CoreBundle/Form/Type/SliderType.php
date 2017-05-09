<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bruery\CoreBundle\Form\DataTransformer\ArrayToStringTransformer;

class SliderType extends AbstractType
{
    /**
     * {@inheritdoc}
     *
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['configs'] = $options;
        $view->vars['configs']['sliderValue'] = $view->vars['data'] ?: implode(',', $view->vars['configs']['sliderValue']);
        if(count($options['ticks']) > 0 ) {
            $view->vars['configs']['ticks'] = implode(',', $options['ticks']);
        } else {
            $view->vars['configs']['ticks'] = null;
        }
        if(count($options['ticksLabels']) > 0 ) {
            $view->vars['configs']['ticksLabels'] = implode(',', $options['ticksLabels']);
        } else {
            $view->vars['configs']['ticksLabels'] = null;
        }

    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new ArrayToStringTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'orientation' => 'horizontal',
            'sliderValue' => [10,20],
            'selection' => 'before',
            'handle' => 'round',
            'ticks'  => [],
            'ticksLabels'  => [],
            'ticksSnapBounds'  => null,
            'sliderSelectionColor' => 'blue',
            //'data' => [10,20]
        ]);
        $resolver->setAllowedValues([
            'orientation' => ['horizontal', 'vertical'],
            'selection' => ['before', 'after'],
            'handle' => ['round', 'square', 'custom'],
            'sliderSelectionColor' => ['blue', 'red', 'green', 'yellow', 'aqua', 'purple']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bruery_slider';
    }
}
