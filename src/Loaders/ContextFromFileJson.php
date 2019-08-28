<?php

namespace XGen\Loaders;

trait ContextFromFileJson
{
    /**
     * @param string $path
     */
    protected function loadContextFromFile(string $path)
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
}
