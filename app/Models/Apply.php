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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function instation()
    {
        return $this->belongsTo(Instation::class, 'instation_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(JobModel::class, 'instation_id', 'instation_id');
    }
}
