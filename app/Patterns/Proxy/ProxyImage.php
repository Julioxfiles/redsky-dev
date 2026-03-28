<?php

namespace App\Patterns\Proxy;

use App\Patterns\Proxy\ImageInterface;
use App\Patterns\Proxy\RealImage;

class ProxyImage implements ImageInterface {
    private string $filename;
    private ?RealImage $realImage = null;

    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    public function display(): void {
        // Lazy loading: solo crear el objeto real si es necesario
        if ($this->realImage === null) {
            echo "Proxy is calling to RealImage to load...<br/>";
            $this->realImage = new RealImage($this->filename);
        }
        echo "Proxy delegating how to show to image to RealImage...<br/>";
        $this->realImage->display();
    }
}