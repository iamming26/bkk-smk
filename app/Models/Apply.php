<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function job()
    {
        return $this->belongsTo(JobModel::class, 'job_id', 'id');
    }
}
