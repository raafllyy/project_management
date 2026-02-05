<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name','description','pm_id','status'];

    public function pm()
    {
        return $this->belongsTo(User::class, 'pm_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function progress()
    {
        if ($this->tasks->count() == 0) return 0;

        $done = $this->tasks->where('status','Done')->count();
        return round(($done / $this->tasks->count()) * 100);
    }
}
