<?php

namespace App\Support;

class Container
{
    private array $instances = [];
    private array $recipes = [];

    public function bind(string $what, \Closure $recipe)
    {
        $this->recipes[$what] = $recipe;
    }

    public function get($what)
    {
        if (empty($this->recipes[$what])) {
            echo "No recipe for making $what";
            die;
        }
        if (empty($this->instances[$what])) {
            $this->instances[$what] = $this->recipes[$what]();
            return $this->instances[$what];
        }

        return $this->instances[$what];
    }

    public function has(string $what): bool
    {
        return isset($this->recipes[$what]);
    }
}
