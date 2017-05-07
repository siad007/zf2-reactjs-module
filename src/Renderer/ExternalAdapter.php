<?php

namespace Siad007\ZF2\ReactJsModule\Renderer;

use Zend\Http\Client;

class ExternalAdapter implements AdapterInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $component Name of component to render
     * @param array  $data      Data to be passed to the component
     *
     * @return string
     */
    public function render($component, array $data = [])
    {
        $client = $this->client;

        $client->setParameterGet(
            [
                'component' => urlencode($component),
                'data' => json_encode($data)
            ]
        );

        return $client->send()->toString();
    }
}
