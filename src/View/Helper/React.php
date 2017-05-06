<?php

namespace Siad007\ZF2\ReactJsModule\Renderer;

use Zend\View\Helper\AbstractHelper;

class React extends AbstractHelper
{
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
}
