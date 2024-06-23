<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

$flChecks = [];
$flChecks[] = function ($line) {
    return stripos($line, 'CREATE');
};
$flChecks[] = function ($line) {
    return stripos($line, 'TABLE');
};
$flChecks[] = function ($line) {
    return stripos($line, '(');
};
$createStatement = new \App\Checker($flChecks);

// Handle
$cursor = getLines(config('file'));
foreach ($cursor as $line) {
    echo (int)$createStatement->check($line);
    echo $line, PHP_EOL;
}
