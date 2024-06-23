<?php

function getLines(string $file): Generator
{
    if (!file_exists($file)) {
        throw new RuntimeException("File '{$file}' not found");
    }
    $fp = fopen($file, 'r');
    while (false !== ($line = fgets($fp))) {
        yield $line;
    }

    fclose($fp);
}


function config(string $key): ?string
{
    $map = [
        'file' => '../storage/samples.sql',
    ];
    return $map[$key] ?? null;
}