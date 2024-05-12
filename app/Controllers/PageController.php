<?php

namespace App\Controllers;

class PageController extends Controller
{
    public function dashboard()
    {
        return $this->render('Pages/dashboard');
    }
}