<?php

namespace Siad007\ZF2\ReactJsModule;

use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ServiceProviderInterface, ViewHelperProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Renderer\ReactRenderer::class => Renderer\ReactJsFactory::class
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
        return [];
    }
}
