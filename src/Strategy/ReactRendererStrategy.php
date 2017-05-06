<?php

namespace Siad007\ZF2\ReactJsModule\Strategy;

use Siad007\ZF2\ReactJsModule\Renderer\ReactRenderer;
use Zend\View\Strategy\PhpRendererStrategy;

class ReactRendererStrategy extends PhpRendererStrategy
{
    public function __construct(ReactRenderer $renderer)
    {
        $this->renderer = $renderer;
    }
}
