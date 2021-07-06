<?php

class Controller
{
    protected $view;

    public function __construct($viewsFile)
    {
        $this->view = $viewsFile;
    }

    public function getViewsContent()
    {
        $this->view = file_get_contents($this->view);
    }
}

?>