<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'status', 'task_date', 'created_at'];
    protected $returnType = 'array';

    public function findForDate(string $date): array
    {
        return $this->where('task_date', $date)
            ->orderBy('created_at', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    public function findAllOrderedByDate(): array
    {
        return $this->orderBy('task_date', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
