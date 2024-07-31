<?php

namespace App\Models;
use App\Models\employees;

use Illuminate\Database\Eloquent\Model;

class EmployeeImage extends Model
{
    protected $table = 'employeeImage';

    protected $fillable = [
        'employee_Id',
        'imageName',
    ];

    public function employee()
    {
        return $this->belongsTo(employees::class, 'employee_Id', 'id');
    }
    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, 'employee_Id', 'id');
    // }

}