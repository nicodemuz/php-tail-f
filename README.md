# tail -f for PHP

A simple implementation to provide "tail -f" functionality in PHP code. Allows you to monitor newly added lines to a given file.

Works cross-platform on both unix and Windows.

This class is designed for implementation within a PHP daemon, specifically excluding its suitability for PHP scripts that generate output for web browsers.

This is a lightweight class that minimally consumes RAM, CPU, or disk I/O resources. There are no dependencies to other libraries.

## Sample usage

```php
<?php

use Nicodemuz\PhpTailF\Monitor;

require 'vendor/autoload.php';

$monitor = new Monitor(
    filePath: '/tmp/test.log',
    sleepMicroseconds: 500000,
);

foreach ($monitor->run() as $output) {
    echo $output;
}
```


## Authors

* [Nico Hiort af Ornäs](https://github.com/nicodemuz)

## Credits

Based on the work from https://github.com/Basch3000/php-tail