@extends('layouts.app')

@section('content')
<h1>Your Tasks</h1>

<a href="{{ route('user.tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>

@if($tasks->count())
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->due_date->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('user.tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('user.tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $tasks->links() }} <!-- pagination links -->

@else
    <p>No tasks found. Create your first task!</p>
@endif

@endsection