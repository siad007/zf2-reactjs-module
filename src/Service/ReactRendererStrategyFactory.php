<?php

namespace Siad007\ZF2\ReactJsModule\Service;

use Interop\Container\ContainerInterface;
use Siad007\ZF2\ReactJsModule\Strategy\ReactRendererStrategy;
use Zend\ServiceManager\FactoryInterface;
use Siad007\ZF2\ReactJsModule\Renderer\ReactRenderer;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReactRendererStrategyFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $viewRenderer = $container->get(ReactRenderer::class);
        return new ReactRendererStrategy($viewRenderer);
    }

    /**
     * Create and return PhpRenderer instance
     *
     * For use with zend-servicemanager v2; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     * @return ReactRenderer
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, ReactRenderer::class);
    }
}
