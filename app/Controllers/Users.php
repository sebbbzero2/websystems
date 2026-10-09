<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Images\Exceptions\ImageException;
use RuntimeException;

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

    public function new()
    {
        return view('user_form', [
            'title'  => 'New User',
            'user'   => null,
            'errors' => session()->getFlashdata('errors') ?? [],
        ]);
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('users/new'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        if (! $model->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s'),
        ])) {
            return redirect()->to(site_url('users/new'))
                ->withInput()
                ->with('errors', $model->errors() ?: ['user' => 'The user could not be created.']);
        }

        return redirect()->to(site_url('users'));
    }

    public function edit(int $id)
    {
        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('user_form', [
            'title'  => 'Edit User',
            'user'   => $user,
            'errors' => session()->getFlashdata('errors') ?? [],
        ]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'username'  => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('users/edit/' . $id))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('avatar');
        $avatar = null;

        if ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            $fileRules = [
                'avatar' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|max_size[avatar,2048]',
            ];

            if (! $this->validate($fileRules)) {
                return redirect()->to(site_url('users/edit/' . $id))
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            try {
                $avatar = $this->prepareAvatar($file);
            } catch (ImageException | RuntimeException $exception) {
                log_message('error', 'Avatar processing failed: {message}', [
                    'message' => $exception->getMessage(),
                ]);

                return redirect()->to(site_url('users/edit/' . $id))
                    ->withInput()
                    ->with('errors', ['avatar' => 'The avatar could not be processed.']);
            }
        }

        $changes = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        if ($avatar !== null) {
            $changes['avatar'] = $avatar;
        }

        if (! $model->update($id, $changes)) {
            if ($avatar !== null) {
                unlink(FCPATH . 'uploads/' . $avatar);
            }

            return redirect()->to(site_url('users/edit/' . $id))
                ->withInput()
                ->with('errors', $model->errors() ?: ['user' => 'The user could not be updated.']);
        }

        if ($avatar !== null && ! empty($user['avatar'])) {
            $oldAvatar = FCPATH . 'uploads/' . basename($user['avatar']);
            if (is_file($oldAvatar)) {
                unlink($oldAvatar);
            }
        }

        return redirect()->to(site_url('users'));
    }

    private function prepareAvatar(UploadedFile $file): string
    {
        $mimeType = $file->getMimeType();
        $extension = match ($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            default      => throw new RuntimeException('Unsupported avatar image type.'),
        };

        $directory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR;

        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
            throw new RuntimeException('Could not create the avatar upload directory.');
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        $path = $directory . $filename;
        $image = service('image', 'gd')
            ->withFile($file->getTempName())
            ->reorient()
            ->fit(300, 300, 'center');

        if (! $image->save($path)) {
            throw new RuntimeException('Could not save the prepared avatar.');
        }

        return $filename;
    }
}