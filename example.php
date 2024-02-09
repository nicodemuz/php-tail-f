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
