<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProjectTask extends Model
{
    use HasFactory;
    protected $table = 'projects_tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'task_id',
        'status_id',
        'designated_id',
        'checked',
        'checked_at',
        'order',
        'priority',
        'separator',
        'open_subtasks',
        'challenge',
        'date',
        'name',
        'phrase',
        'description',
        'status',
        'filed_by',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the creator associated with the tasks.
     */
    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    /**
     * Get the comments associated with the tasks.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ProjectComment::class, 'task_id', 'id');
    }

    /**
     * Get the subtask associated with the tasks.
     */
    public function subtasks(): HasMany
    {
        return $this->hasMany(ProjectTask::class, 'task_id', 'id');
    }

    /**
     * Get the subtask associated with the tasks.
     */
    public function father(): HasOne
    {
        return $this->hasOne(ProjectTask::class, 'id', 'task_id');
    }

    /**
     * Get the subtask associated with the tasks.
     */
    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class);
    }

    /**
     * Get the creator associated with the tasks.
     */
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * Get the creator associated with the tasks.
     */
    public function designated(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'designated_id');
    }

    /**
     * Get the creator associated with the tasks.
     */
    public function statusInfo(): HasOne
    {
        return $this->hasOne(ProjectStatus::class, 'id', 'status_id');
    }
}
