<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'team';
    protected $primaryKey = 'member_id';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'project_id',
        'employee_id',
        'role',
        'is_active',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class,'employee_id');
    }
}
