<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddProjects extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId', 'projectcompany', 'projectname','pmemployeeId','pmallocation', 'currency', 'projectbudget', 'projecttype',
        'csm', 'tags', 'sc', 'status',
        'cilentname', 'cilentemail', 'companyname', 'cilentphone', 'country', 'city',
        'projectstartdate', 'projectenddate',
    ];
    protected $table = 'projects';

    public function employee()
    {
        return $this->belongsTo(AddWorkesEmployee::class, 'userId', 'userId');
    }
}
