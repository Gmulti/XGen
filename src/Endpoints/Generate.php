<?php

namespace XGen\Endpoints;

use XGen\XGen;

class Generate extends AbstractEndpoint
{
    const RESOURCE_NAME = 'generate';

    /**
     * @return array
     */
    public function postGenerate($data)
    {
        return $this->makeRequest('POST', '/v1/generate', json_encode($data));
    }

    public function postGenerateWithXGen(XGen $xgen)
    {
        return $this->postGenerate($xgen->getDataForEndpoint());
    }
}
