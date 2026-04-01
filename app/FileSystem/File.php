<?php

namespace App\FileSystem;

class File implements Component
{
    public function __construct(
        private string $name,
        private int $size
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}