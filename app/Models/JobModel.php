<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobModel extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $guarded = ['id'];

    public function instation()
    {
        return $this->belongsTo(Instation::class, 'instation_id', 'id');
    }
}
