<?php

namespace Siad007\ZF2\ReactJsModule\Factory;

use ReactJS;
use Siad007\ZF2\ReactJsModule\Exception\FileNotReadableException;
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
     * @return ReactJs
     *
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Siad007\ZF2\ReactJsModule\Exception\FileNotReadableException
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {

        $helper = new React();
    }

    /**
     * Create and return PhpRenderer instance
     *
     * For use with zend-servicemanager v2; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     * @return ReactJs
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, React::class);
    }
}
