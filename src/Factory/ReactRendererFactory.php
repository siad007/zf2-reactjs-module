<?php

namespace Siad007\ZF2\ReactJsModule\Factory;

use ReactJS;
use Siad007\ZF2\ReactJsModule\Exception\InvalidConfigurationException;
use Siad007\ZF2\ReactJsModule\Exception\FileNotReadableException;
use Siad007\ZF2\ReactJsModule\Renderer\ExternalAdapter;
use Siad007\ZF2\ReactJsModule\Renderer\ReactRenderer;
use Siad007\ZF2\ReactJsModule\Renderer\V8jsAdapter;
use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReactRendererFactory implements FactoryInterface
{
    /**
     * @param  ContainerInterface $container
     * @param  string $name
     * @param  null|array $options
     *
     * @return ReactRenderer
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

        if (!isset($config['zf2reactjsmodule']['render_method'])) {
            throw new InvalidConfigurationException('You must set the "render_method" key.');
        }

        if ('external' === $config['zf2reactjsmodule']['render_method']) {
            if (!isset($config['zf2reactjsmodule']['render_url'])) {
                throw new InvalidConfigurationException(
                    'You must set the "render_url" key if "render_method" is "external".'
                );
            }
            $adapter = new ExternalAdapter();
        } elseif ('v8js' === $config['zf2reactjsmodule']['render_method']) {
            $adapter = new V8jsAdapter($container->get(ReactJS::class));
        } else {
            throw new InvalidConfigurationException('You must set the "render_method" key to either "v8js" or "external".');
        }

        return new ReactRenderer($adapter);
    }

    /**
     * Create and return PhpRenderer instance
     *
     * For use with zend-servicemanager v2; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     *
     * @return ReactRenderer
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, ReactJS::class);
    }
}
