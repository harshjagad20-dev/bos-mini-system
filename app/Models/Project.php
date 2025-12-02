<?php

namespace App\Models;

use App\Builders\ProjectBuilder;
use App\Http\Requests\ProjectRequest;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public const STATUS_PENDING = 'PENDING';
    public const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    public const STATUS_COMPLETED = 'COMPLETED';

    public function newEloquentBuilder($query)
    {
        return new ProjectBuilder($query);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public static function createFromRequest(ProjectRequest $request)
    {
        return self::create($request->getProjectPayload());
    }
}
