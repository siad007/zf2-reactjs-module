<?php

namespace Siad007\ZF2\ReactJsModule\Renderer;

use Siad007\ZF2\ReactJsModule\Exception\ComponentNotRenderedException;
use Zend\View\Helper\AbstractHelper;

class React extends AbstractHelper
{
    /** @var ReactRenderer $renderer */
    private $renderer;

    private $tag = 'div';

    /**
     * @var array
     */
    private $componentsJs = [];

    public function __construct(ReactRenderer $renderer, $wrapperTag = 'div')
    {
        $this->renderer = $renderer;
        $this->tag = $wrapperTag;
    }

    /**
     * Render a react component's markup and store it's js for mounting later
     *
     * @param string $componentName
     * @param string $containerId
     * @param mixed  $data
     *
     * @return string
     */
    public function renderReactComponent($componentName, $containerId, $data = [])
    {
        $this->componentsJs[$componentName] = $this->renderer->getRenderJs(
            $componentName,
            sprintf('document.getElementById("%s")', $containerId)
        );
        return sprintf($this->getWrapper(), $containerId, $this->renderer->render($componentName, $data));
    }

    /**
     * Mount all components
     *
     * @return string
     */
    public function renderReactComponentsJs()
    {
        return implode("\n", $this->componentsJs);
    }

    /**
     * Mount a single react component
     *
     * @param string $componentName
     */
    public function renderReactComponentJs($componentName)
    {
        if (!isset($this->componentsJs[$componentName])) {
            throw new ComponentNotRenderedException(
                'You must render a component before it can be mounted.'
            );
        }
        return $this->componentsJs[$componentName];
    }
    /**
     * @return string
     */
    protected function getWrapper()
    {
        return "<$this->tag id=\"%s\">%s</$this->tag>";
    }
}
