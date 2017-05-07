<?php

namespace Siad007\ZF2\ReactJsModule;

use Siad007\ZF2\ReactJsModule\Service\ReactRendererStrategyFactory;
use Siad007\ZF2\ReactJsModule\Strategy\ReactRendererStrategy;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface, ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @inheritdoc
     */
    public function getServiceConfig()
    {
        return [
            'aliases' => [
                'ViewReactRenderer' => Renderer\ReactRenderer::class,
                'ViewReactStrategy' => Strategy\ReactRendererStrategy::class
            ],
            'factories' => [
                Renderer\ReactRenderer::class => Service\ViewReactRendererFactory::class,
                Strategy\ReactRendererStrategy::class => ReactRendererStrategyFactory::class,
            ]
        ];
    }

    public function onBootstrap(EventInterface $e)
    {
        /** @var MvcEvent $e */
        $sharedEvents = $e->getApplication()->getEventManager()->getSharedManager();
        $sm = $e->getApplication()->getServiceManager();

        $sharedEvents->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function($e) use ($sm) {
            $strategy = $sm->get(ReactRendererStrategy::class);
            $view     = $sm->get('ViewManager')->getView();
            $strategy->attach($view->getEventManager());
        }, 100);
    }
}
