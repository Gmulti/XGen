<?php

namespace XGen\Loaders;

trait SourceFromFileJson
{
    /**
     * @param string $path
     */
    public function loadSourceFromFile(string $path)
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
    public function addSourceFromFile(string $path)
    {
        $source = $this->loadSourceFromFile($path);

        if (null !== $source) {
            $this->addSource($source);
        }

        return $this;
    }
}
