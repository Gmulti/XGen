<?php

namespace XGen;

use XGen\Loaders\ContextFromFileJson;
use XGen\Loaders\SourceFromFileJson;

class XGen
{
    use ContextFromFileJson;
    use SourceFromFileJson;

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
     * @param string $path
     */
    public function addContextFromFile(string $path)
    {
        $context = $this->loadContextFromFile($path);

        if (null !== $context) {
            $this->addContext($context);
        }

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

    /**
     * @param string $path
     */
    public function addSourceFromFile(string $path)
    {
        $source = $this->loadSourceFromFile($path);

        if (null !== $source) {
            $this->addSource($source);
        }

        return $this;
    }

    public function getSource()
    {
        return $this->source;
    }

    /**
     *
     * @return array
     */
    public function getDataForEndpoint() : array {
        return [
            "settings" => $this->getContexts(),
            "source" => $this->getSource(),
        ];
    }
}
