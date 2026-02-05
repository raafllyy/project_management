<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'deadline',
        'created_by',
        'status'
    ];

    // Relasi members
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members');
    }

    // Relasi creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Accessor untuk status
    public function getStatusAttribute()
    {
        $totalTasks = $this->tasks()->count();

        if ($totalTasks === 0) {
            return 'Pending';
        }

        $doneTasks = $this->tasks()
            ->where('status', 'Done')
            ->count();

        if ($doneTasks < $totalTasks) {
            return 'Active';
        }

        return 'Complete';
    }

    // Progress project
    public function progress()
    {
        $total = $this->tasks()->count();

        if ($total === 0) {
            return 0;
        }

        $done = $this->tasks()->where('status', 'Done')->count();

        return round(($done / $total) * 100);
    }
}