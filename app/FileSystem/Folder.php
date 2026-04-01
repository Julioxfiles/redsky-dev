<?php

namespace App\FileSystem;

class Folder implements Component
{
    private array $children = [];

    public function __construct(private string $name) {}

    public function add(Component $component): void
    {
        $this->children[] = $component;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        $total = 0;

        foreach ($this->children as $child) {
            $total += $child->getSize();
        }

        return $total;
    }
}