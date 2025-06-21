<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    private const VIEWS_DIRECTORY = 'Home/';

    public function index(): string
    {
        $this->dataToView['title'] = 'Dashboard';
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }
}
