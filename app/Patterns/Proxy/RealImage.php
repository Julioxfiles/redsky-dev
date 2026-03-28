<?php

namespace App\Patterns\Proxy;

class RealImage implements ImageInterface {
    private string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->loadFromDisk();
    }

    private function loadFromDisk(): void {
        echo "RealImage is Loading imagen: {$this->filename} <br/>";
    }

    public function display(): void {
        echo "RealImage is Showing imagen: {$this->filename} <br/>";
    }
}