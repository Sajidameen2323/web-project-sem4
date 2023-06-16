<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    public $timestamps = true;
    

    protected $fillable = [
        'project_name',
        'subtitle',
        'start_date',
        'end_date',
        'project_manager',
        'team_lead',
        'status',
        'priority',
        'description',
        'frontend',
        'backend',
        'database'
    ];

    // Relationship with project manager
    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager');
    }

    // Relationship with team lead
    public function teamLead()
    {
        return $this->belongsTo(User::class, 'team_lead');
    }
}
