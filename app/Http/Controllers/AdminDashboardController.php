<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        // Get all users with their tasks
        $users = User::with('tasks')->get();

        return view('admin.dashboard', compact('users'));
    }

    // Delete User
    public function destroyUser(User $user)
    {
        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }

    // Delete Task
    public function destroyTask(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task deleted successfully');
    }
}