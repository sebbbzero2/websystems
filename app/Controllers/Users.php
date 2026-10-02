<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $users = (new UserModel())->findAll();

        $data = [
            'title' => 'User Accounts',
            'users' => $users
        ];

        return view('users', $data);
    }
}