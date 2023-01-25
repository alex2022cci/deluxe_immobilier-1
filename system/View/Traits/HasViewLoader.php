<?php

namespace System\View\Traits;

trait HasViewLoader
{
    private $viewNameArray = [];
    
    private function viewLoader()
    {
        $dir = trim($dir, '.');
        $dir = str_replace(".", "/", $dir);
        if(file_exists(dirname(dirname(__DIR__))."/ressources/view/$dir.blade.php"))
        {
            $this->registerView($dir);
            $content = htmlentities(file_get_contents(dirname(dirname(dirname(__DIR__)))."/ressources/view/$dir.blade.php"));
            return $content;
        }
        else
        {
            throw new \Exception('view not found !');
        }
    }
    private function registerView($view)
    {
        array_push($this->viewNameArray, $view);
        // $this->viewNameArray[] = $view;
    }
}
