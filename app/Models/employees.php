<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    use HasFactory;
    protected $fillable = [
        'empId',
        'emergencycontact',
        'pannumber',
        'name',
        'currentaddress',
        'trainingcompletion',
        'department',
        'permanentaddress',
        'comnpanyexperience',
        'designation',
        'city',
        'employeestatus',
        'reportingmanager',
        'dob',
        'lastworkingday',
        'officialemail',
        'joiningdate',
        'personalemail',
        'higestqualification',
        'contactdetails',
        'aadharnumber',
    ];
    public function getDepartmentName()
    {
        
        $departments = [
            0 => 'Delivery',
            1 => 'Marketing',
            2 => 'Admin',
            3 => 'HR',
            4 => 'Business',
            5 =>'Business Admin'
        ];

        
        if (array_key_exists($this->department, $departments)) {
          
            return $departments[$this->department];
        } else {
            
            return 'Unknown Department';
        }
    }
    public function employeeImage()
    {
        return $this->hasOne(EmployeeImage::class, 'employee_Id', 'id');
    }


}
