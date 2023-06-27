<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tasks';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'title',
        'state',
        'description',
        'project_id',
        'assigned_to',
        'priority',
        'effort',
        'target_date',
        'risk',
        'type'
    ];

    // Define the relationships

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to')->withDefault();
    }
}
