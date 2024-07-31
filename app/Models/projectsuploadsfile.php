<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectsuploadsfile extends Model
{

    use HasFactory;

    protected $fillable = [
        'project_id',
        'category',
        'contract',
    ];

    protected $table = 'projectsuploadsfile';

    // Accessor to decode the contract JSON
    public function getContractFilesAttribute()
    {
        return json_decode($this->contract, true);
    }

    // Relationship with Project model (if applicable)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
