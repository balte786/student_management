<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexManagement extends Model
{
    use HasFactory;
    protected $table = 'index_managements';

    public function school(){
        return $this->belongsTo(School::class, ['school_id', 'quota_id'],['school_id', 'quota_id']);
    }
    public function quota(){
        return $this->belongsTo(School::class, ['school_id', 'quota_id'],['school_id', 'quota_id']);
    }
}
