<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Jobs\SendTaskNotificationJob;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(TaskRequest $request, Project $project)
    {
        $this->authorize('create', [Task::class, $project]);

        $task = Task::createFromRequest($request, $project);

        SendTaskNotificationJob::dispatch($task);

        return new TaskResource($task->load('assignedUser'));
    }
}
