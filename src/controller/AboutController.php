<?php

class AboutController
{
    public function run($action)
    {
        $this->$action();
    }

    private function index()
    {
        include __DIR__ . '/../views/about.php';
    }
}
