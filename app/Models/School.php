<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    public function school_category(){
        return $this->belongsTo('App\Model\SchoolCategory', 'category_id');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
