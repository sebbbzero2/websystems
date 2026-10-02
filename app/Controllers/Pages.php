<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'POS System'
        ];

        return view('home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About'
        ];

        return view('about', $data);
    }
}