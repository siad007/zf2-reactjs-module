<?php

namespace Siad007\ZF2\ReactJsModule;

use Siad007\ZF2\ReactJsModule\Factory\ReactViewHelperFactory;
use Siad007\ZF2\ReactJsModule\View\Helper\React;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ServiceProviderInterface, ViewHelperProviderInterface
{
    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Renderer\ReactRenderer::class => Factory\ReactJsFactory::class
            ]
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
                React::class => ReactViewHelperFactory::class
            ]
        ];
    }
}
