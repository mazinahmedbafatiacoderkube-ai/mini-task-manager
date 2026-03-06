@extends('layouts.app')

@section('content')

<h2>Edit Task</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('user.tasks.update', $task->id) }}">
    @csrf
    @method('PUT')

    <div>
        <label>Title</label><br>
        <input type="text" name="title" value="{{ $task->title }}" required>
    </div>

    <br>

    <div>
        <label>Description</label><br>
        <textarea name="description">{{ $task->description }}</textarea>
    </div>

    <br>

    <div>
        <label>Status</label><br>
        <select name="status" required>
            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <br>

    <div>
        <label>Due Date</label><br>
        <input type="date" name="due_date"
               value="{{ $task->due_date->format('Y-m-d') }}" required>
    </div>

    <br>

    <button type="submit">Update Task</button>

</form>

@endsection
