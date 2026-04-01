<?php

namespace App\FileSystem;

interface Component
{
    public function getName(): string;
    public function getSize(): int;
}