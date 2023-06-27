<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;
    
    protected $table = 'discussions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'task_id',
        'user_id',
        'content',
       
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
