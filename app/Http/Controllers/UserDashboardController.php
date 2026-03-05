<?php

namespace App\Http\Controllers;

class UserDashboardController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->paginate(10);

        return view('dashboard', compact('tasks'));
    }
}