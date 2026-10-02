<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customers = (new CustomerModel())->findAll();

        $data = [
            'title'     => 'Customer Accounts',
            'customers' => $customers
        ];

        return view('customers', $data);
    }
}