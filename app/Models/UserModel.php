<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'full_name', 'email', 'created_at'];
    protected $returnType = 'array';

    /**
     * @return array<string, mixed>|null
     */
    public function findDemoUser(): ?array
    {
        return $this->where('username', 'demo_user')->first();
    }
}