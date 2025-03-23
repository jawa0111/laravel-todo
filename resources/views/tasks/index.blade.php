<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Set background image */
        body {
            background-image: url('{{ asset('images/background.jpg') }}'); /* Adjust path if necessary */
            background-size: cover; /* Ensures the image covers the entire screen */
            background-position: center center; /* Centers the background image */
            background-attachment: fixed; /* Keeps the background fixed while scrolling */
            color: white; /* Optional: Text color for contrast */
        }

        /* Additional styling for the To-Do list container */
        .container {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            padding: 20px;
            border-radius: 10px;
            max-width: 600px; /* Optional: Set a max-width for better appearance */
            margin-top: 50px; /* Optional: Adds some space at the top */
        }

        h2 {
            text-align: center;
            color: white;
        }

        .list-group-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>To-Do List</h2>

        <!-- Add Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="text" name="task" class="form-control" placeholder="New Task" required>
            <button type="submit" class="btn btn-primary mt-2">Add Task</button>
        </form>

        <!-- Task List -->
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <!-- Mark Task as Done Button -->
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $task->completed ? 'btn-success' : 'btn-warning' }}">
                            {{ $task->completed ? 'Completed' : 'Mark as Done' }}
                        </button>
                    </form>

                    <!-- Task Name with Color Based on Completion -->
                    <span class="{{ $task->completed ? 'text-success' : '' }}">{{ $task->task }}</span>

                    <!-- Delete Task Button -->
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>
