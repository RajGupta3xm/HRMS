<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'employee_id', 'date', 'day', 'hours', 'status'];

    public function project()
    {
        return $this->belongsTo(AddProjects::class, 'project_id');
    }
    public function employee()
    {
        return $this->belongsTo(employees::class, 'employee_id');
    }
    public function addworkesEmployees()
    {
        return $this->hasMany(AddworkesEmployee::class, 'project_id', 'project_id');
    }
}
