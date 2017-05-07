<?php

namespace Siad007\ZF2\ReactJsModule\Model;

use Zend\View\Model\ViewModel;

class ReactModel extends ViewModel
{
    /**
     * @param string $component Name of component
     * @param string $where     Id of container in which component is rendered
     * @param array  $data      Data to be passed to the component
     *
     * @return string
     */
    public function getRenderJs($component, $where, array $data = [])
    {
        return
            sprintf(
                'React.render(React.createElement(%s, %s), %s);',
                $component,
                json_encode($data),
                $where
            );
    }
}
