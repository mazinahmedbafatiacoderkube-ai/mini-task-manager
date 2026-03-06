@extends('layouts.app')

@section('content')

<h2>Create New Task</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('user.tasks.store') }}">
    @csrf

    <div>
        <label>Title</label><br>
        <input type="text" name="title" value="{{ old('title') }}" required>
    </div>

    <br>

    <div>
        <label>Description</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <br>

    <div>
        <label>Status</label><br>
        <select name="status" required>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
    </div>

    <br>

    <div>
        <label>Due Date</label><br>
        <input type="date" name="due_date" value="{{ old('due_date') }}" required>
    </div>

    <br>

    <button type="submit">Create Task</button>

</form>

@endsection