<?php

namespace App;

use Closure;

class Checker
{
    /**
     * @var Closure[]
     */
    private array $checks;
    private string $handler;

    /**
     * @param Closure[] $checks
     * @param string $strategy
     */
    public function __construct(array $checks, string $strategy = 'all')
    {
        $this->checks = $checks;
        $this->handler = $strategy;
    }

    public function check(string $content): bool
    {
        $results = [];
        foreach ($this->checks as $check) {
            $results[] = $check($content);
        }
        if ($this->handler === 'all') {
            return $this->applyAllChecks($results);
        }
        return false;
    }

    /**
     * @param false[]|int[] $checked
     * @return bool
     */
    protected function applyAllChecks(array $checked): bool
    {
        $prev = -1;
        foreach ($checked as $check) {
            if ($check === false) return false;
            if ($prev >= $check) return false;
            $prev = $check;
        }

        return true;
    }
}