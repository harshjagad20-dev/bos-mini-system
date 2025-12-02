<?php

namespace App\Models;

use App\Http\Requests\TaskRequest;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public const STATUS_OPEN = 'OPEN';
    public const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    public const STATUS_DONE = 'DONE';

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public static function createFromRequest(TaskRequest $request, $project)
    {
        return $project->tasks()->create($request->getTaskPayload());
    }
}
