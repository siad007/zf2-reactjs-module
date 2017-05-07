<?php

namespace Siad007\ZF2\ReactJsModule\Factory;

use Siad007\ZF2\ReactJsModule\Renderer\ReactRenderer;
use Siad007\ZF2\ReactJsModule\View\Helper\React;
use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReactViewHelperFactory implements FactoryInterface
{
    /**
     * @param  ContainerInterface $container
     * @param  string $name
     * @param  null|array $options
     *
     * @return React
     *
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Siad007\ZF2\ReactJsModule\Exception\FileNotReadableException
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        // test if we are using Zend\ServiceManager v2 or v3
        if (! method_exists($container, 'configure')) {
            $container = $container->getServiceLocator();
        }

        return new React($container->get(ReactRenderer::class));
    }

    /**
     * Create and return PhpRenderer instance
     *
     * For use with zend-servicemanager v2; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     * @return React
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, React::class);
    }
}
