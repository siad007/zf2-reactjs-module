<?php

namespace Siad007\ZF2\ReactJsModule\Service;

use Siad007\ZF2\ReactJsModule\Strategy\ReactRendererStrategy;
use Zend\ServiceManager\FactoryInterface;
use Siad007\ZF2\ReactJsModule\Renderer\ReactRenderer;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReactRendererStrategyFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewRenderer = $serviceLocator->get(ReactRenderer::class);
        return new ReactRendererStrategy($viewRenderer);
    }
}
