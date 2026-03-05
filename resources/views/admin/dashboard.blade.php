@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Admin Dashboard</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @foreach($users as $user)

        <div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">

            <h3>
                {{ $user->name }} ({{ $user->email }})
            </h3>

            <!-- Delete User -->
            <form action="{{ route('admin.user.delete', $user->id) }}"
                  method="POST"
                  style="margin-bottom:10px;">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('Delete this user?')">
                    Delete User
                </button>
            </form>

            <h4>Tasks:</h4>

            @if($user->tasks->count() > 0)

                <ul>
                    @foreach($user->tasks as $task)
                        <li>
                            <strong>{{ $task->title }}</strong>
                            ({{ $task->status }})

                            <!-- Delete Task -->
                            <form action="{{ route('admin.task.delete', $task->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Delete this task?')">
                                    Delete Task
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>

            @else
                <p>No tasks assigned.</p>
            @endif

        </div>

    @endforeach

</div>

@endsection