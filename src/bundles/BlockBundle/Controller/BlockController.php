<?php

/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\BlockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sonata\BlockBundle\Block\BlockServiceManagerInterface;
use Sonata\BlockBundle\Block\Service\AbstractAdminBlockService;
use Sonata\BlockBundle\Block\BlockContext;
use Sonata\BlockBundle\Util\OptionsResolver;

class BlockController extends Controller
{
    /**
     * Default render action
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function renderAction(Request $request)
    {

        //TODO: render initial block via ajax
        $blockType = $request->get('blockType', null);
        $action    = $request->get('action', null);

        // merge all parameters
        $params = array_merge($request->request->all(), $request->query->all());

        // load block service
        $block = $this->getBlockServiceManager()->getService($blockType);
        if (!$block) {
            throw $this->createNotFoundException(sprintf('Cannot find block service "%s"', $blockType));
        }

        if(!$block instanceof AbstractAdminBlockService) {
            throw new \Exception('Block should be an instance of AbstractAdminBlockService');
        }

        $params['block'] = $block;

        $methodName = sprintf("%sAction", $action);

        if (!is_callable(array($block, $methodName), false)) {
            throw $this->createNotFoundException(sprintf('Cannot find method "%s" in block service "%s"', $methodName, $blockType));
        }

        return call_user_func_array(array($block, $methodName), array($request, $params));
    }

    /**
     * Default render action
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function fetchDataAction(Request $request)
    {
        $blockType = $request->get('blockType', null);
        $action    = $request->get('action', null);

        // merge all parameters
        $params = array_merge($request->request->all(), $request->query->all());

        // load block service
        $block = $this->getBlockServiceManager()->getService($blockType);
        if (!$block) {
            throw $this->createNotFoundException(sprintf('Cannot find block service "%s"', $blockType));
        }

        if(!$block instanceof AbstractAdminBlockService) {
            throw new \Exception('Block should be an instance of AbstractAdminBlockService');
        }

        $methodName = sprintf("%sAction", $action);

        if (!is_callable(array($block, $methodName), false)) {
            throw $this->createNotFoundException(sprintf('Cannot find method "%s" in block service "%s"', $methodName, $blockType));
        }

        return call_user_func_array(array($block, $methodName), array($request, $params));
    }

    /**
     * Get Block Service Manager
     *
     * @return BlockServiceManagerInterface
     */
    protected function getBlockServiceManager()
    {
        return $this->get('sonata.block.manager');
    }
}
