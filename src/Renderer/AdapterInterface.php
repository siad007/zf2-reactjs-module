<?php

namespace Siad007\ZF2\ReactJsModule\Renderer;

interface AdapterInterface
{
    /**
     * @param string $component Name of the component
     * @param array  $data      Data to pass to the component
     *
     * @return string
     */
    public function render($component, array $data = []);
}
