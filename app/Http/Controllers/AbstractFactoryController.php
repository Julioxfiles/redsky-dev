<?php

namespace App\Http\Controllers;

use App\Factories\UIFactory; 
use App\Factories\Concrete\DarkFactory;
use App\Factories\Concrete\LightFactory;

// It could be called ThemeController
class AbstractFactoryController {

    public string $name;
    
    public function lightTheme() {
        $this->name = "light";
        $this->renderUI(new LightFactory());
        // Switch the whole family.
    }

    public function darkTheme() {
        $this->name = "dark";
        $this->renderUI(new DarkFactory());
    }

    public function renderUI(UIFactory $factory)
    {
        $button = $factory->createButton();
        $input = $factory->createInput();

        echo $button->render().br();
        echo $input->render().br();
    }
  
}