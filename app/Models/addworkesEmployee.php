<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddworkesEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'userDepartment',
        'userDesignation',
        'employee_Id',
        'allocationpercentage',
        'status',
        'startdate',
        'enddate',
    ];

    protected $table = 'addworkes_employees';

    public function project()
    {
        return $this->belongsTo(AddProjects::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_Id');
    }

    public function employee()
    {
        return $this->belongsTo(employees::class, 'employee_Id');
    }
    
}
