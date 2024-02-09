<?php

namespace Nicodemuz\PhpTailF;

use Generator;

class Monitor
{
    private int $lastModified = 0;
    private int $lastSize = 0;

    public function __construct(
        private readonly string $filePath,
        private readonly int $sleepMicroseconds
    ) {
    }

    public function run(): Generator
    {
        $filePointer = fopen($this->filePath, "r");
        while(true)
        {
            clearstatcache(false, $this->filePath);
            $modified = filemtime($this->filePath);

            if($modified == $this->lastModified) {
                usleep($this->sleepMicroseconds);
                continue;
            }

            $this->lastModified = $modified;

            $lastSize = filesize($this->filePath);
            $bytesAdded = $lastSize - $this->lastSize;
            $this->lastSize = $lastSize;

            if($bytesAdded == $lastSize)
            {
                fseek($filePointer, $lastSize);
                usleep($this->sleepMicroseconds);
                continue;
            }

            fseek($filePointer, -$bytesAdded);
            $added = fread($filePointer, $lastSize);

            yield $added;

            usleep($this->sleepMicroseconds);
        }
    }
}