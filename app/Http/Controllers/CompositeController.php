<?php

namespace App\Http\Controllers;
use App\FileSystem\File;
use App\FileSystem\Folder;

// This could be called FileController.
class CompositeController {
    public function index() {
        $root = new Folder('root');

        $file1 = new File('file1.txt', 100);
        $file2 = new File('file2.txt', 200);

        $subFolder = new Folder('subfolder');
        $subFolder->add(new File('file3.txt', 300));

        $root->add($file1);
        $root->add($file2);
        $root->add($subFolder);

        echo $root->getName().br(); // root
        echo $root->getSize().br(); // 600
    }
}