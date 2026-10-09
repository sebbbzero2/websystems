<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Pages extends BaseController
{
    public function index()
    {
        $today = Time::today()->toDateString();

        return view('tasks/today', [
            'title' => 'Tasks for Today',
            'today' => Time::parse($today)->toLocalizedString('EEEE, MMMM d, yyyy'),
            'tasks' => (new TaskModel())->findForDate($today),
        ]);
    }

    public function tasks()
    {
        return view('tasks/list', [
            'title' => 'All Tasks',
            'tasks' => (new TaskModel())->findAllOrderedByDate(),
        ]);
    }

    public function profile()
    {
        return view('tasks/profile', [
            'title' => 'Demo Profile',
            'user' => (new UserModel())->findDemoUser(),
        ]);
    }

    public function about()
    {
        return view('tasks/about', [
            'title' => 'About This Project',
        ]);
    }
}