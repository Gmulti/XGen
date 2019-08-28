# XGen SDK PHP

> Official PHP SDK of the XGen API.

---

API Documentation : https://thomas-15.gitbook.io/generator/

## Requirements

-   PHP version 7.2 and later
-   XGen API Key, [contact me](https://twitter.com/TDeneulin)

## Installation

You can install the library via [Composer](https://getcomposer.org/). Run the following command:

```bash
composer require gmulti/xgen
```

To use the library, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require_once __DIR__. '/vendor/autoload.php';
```

## Example

### Authentication

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use XGen\Client;
use XGen\XGen;

try {
    $xgen = new XGen();
    $xgen->addContextFromFile(__DIR__ . '/vendor/gmulti/xgen/data/context-1.json');
    $xgen->addContextFromFile(__DIR__ . '/vendor/gmulti/xgen/data/context-2.json');
    $xgen->addSourceFromFile(__DIR__ . '/vendor/gmulti/xgen/data/source.json');

    $client = new Client('API_KEY');
    $result = $client->getResource('generate')->postGenerateWithXGen($xgen);
    var_dump($result);
    // array (size=1)
    //   'text' => string 'Dans le cadre de la 2ème journée, Angers SCO accueille Olympique Lyonnais' (length=75)
    
} catch (\Exception $e) {
}

```

## About

`xgen` is guided and supported by the Thomas Deneulin.