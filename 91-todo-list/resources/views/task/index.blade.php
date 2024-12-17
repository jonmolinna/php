<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Todo List</title>
</head>
<body>

    <!-- routes/web -->
    <form action="{{ url('/task') }}" method="post">
        @csrf
        <input type="text" name="name" id="task">
        <input type="submit" value="Enviar">
    </form>

    <br>

    <table border="1">
        <tr>
            <th>Tarea</th>
            <th>Acciones</th>
        </tr>

        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>
                    <form action="{{ route('task.destroy', $task->id) }}" method="post">
                        @csrf()
                        @method('DELETE')
                        <input type="submit" value="x">
                    </form>
                    <a href="{{ route('task.edit', $task->id) }}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
    
</body>
</html>