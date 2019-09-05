<?php

namespace XGen;

use XGen\Loaders\ContextFromFileJson;
use XGen\Loaders\SourceFromFileJson;
use XGen\Loaders\SourceFromUrlJson;

class XGen
{
    use ContextFromFileJson;
    use SourceFromFileJson;
    use SourceFromUrlJson;

    protected $contexts = [];

    protected $source = null;

    /**
     * @param array $context
     */
    public function addContext(array $context)
    {
        $this->contexts[] = $context;

        return $this;
    }

    /**
     * @return array
     */
    public function getContexts(): array
    {
        return $this->contexts;
    }

    public function addSource($source)
    {
        $this->source = $source;

        return $this;
    }

    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return array
     */
    public function getDataForEndpoint(): array
    {
        return [
            'settings' => $this->getContexts(),
            'source'   => $this->getSource(),
        ];
    }
}
