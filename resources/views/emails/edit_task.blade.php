<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h2>Task Details:</h2>
    <p><strong>Title:</strong> {{ $task->title }} </p>
    <p><strong>Description:</strong> {{ $task->description }} </p>
    <p><strong>Priority:</strong> {{ $task->priority }} </p>
    <p><strong>From Date:</strong> {{ $task->start_date->format('Y-m-d') }} </p>
    <p><strong>To Date:</strong> {{ $task->end_date->format('Y-m-d') }} </p>
    <p><strong>Created By:</strong> {{ $task->createdBy->name }} </p>
    <p><strong>Created date:</strong> {{ $task->created_at->format('Y-m-d H:i:s') }} </p>
    <hr>

    <p>This is a notification email for a edit task. Please review the task details and take necessary actions.
        <a href="{{route('tasks.show',$task->id)}}">Click Here</a>
    </p>

</body>
</html>
