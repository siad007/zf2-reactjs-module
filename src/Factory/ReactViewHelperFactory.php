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
        // test if we are using Zend\ServiceManager v2 or v3
        if (! method_exists($container, 'configure')) {
            $container = $container->getServiceLocator();
        }

        $config = $container->get('config');

        $reactPath = isset($config['view_helper_config']['zf2reactjsmodule']['react_path'])
            ? $config['view_helper_config']['zf2reactjsmodule']['react_path']
            : null;

        $componentsPath = isset($config['view_helper_config']['zf2reactjsmodule']['components_path'])
            ? $config['view_helper_config']['zf2reactjsmodule']['components_path']
            : null;

        if (!is_readable($reactPath)) {
            throw new FileNotReadableException(sprintf('React path "%s" is not readable.', $reactPath));
        }
        if (!is_readable($componentsPath)) {
            throw new FileNotReadableException(sprintf('Components path "%s" is not readable.', $componentsPath));
        }
        $react = file_get_contents($reactPath);
        $js = file_get_contents($componentsPath);

        return new ReactJS($react, $js);
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
