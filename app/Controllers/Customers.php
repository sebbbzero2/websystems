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

    public function new()
    {
        return view('customer_form', [
            'title'    => 'New Customer',
            'customer' => null,
            'errors'   => session()->getFlashdata('errors') ?? [],
        ]);
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('customers/new'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new CustomerModel();
        if (! $model->insert([
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s'),
        ])) {
            return redirect()->to(site_url('customers/new'))
                ->withInput()
                ->with('errors', $model->errors() ?: ['customer' => 'The customer could not be created.']);
        }

        return redirect()->to(site_url('customers'));
    }

    public function edit(int $id)
    {
        $customer = (new CustomerModel())->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('customer_form', [
            'title'    => 'Edit Customer',
            'customer' => $customer,
            'errors'   => session()->getFlashdata('errors') ?? [],
        ]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('customers/edit/' . $id))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        if (! $model->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ])) {
            return redirect()->to(site_url('customers/edit/' . $id))
                ->withInput()
                ->with('errors', $model->errors() ?: ['customer' => 'The customer could not be updated.']);
        }

        return redirect()->to(site_url('customers'));
    }
}