<?php

namespace XGen\Loaders;

trait ContextFromFileJson
{
    /**
     * @param string $path
     */
    public function loadContextFromFile(string $path)
    {
        if (!file_exists($path)) {
            return null;
        }

        try {
            return json_decode(file_get_contents($path), true);
        } catch (\Exception $th) {
            return null;
        }
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
}
