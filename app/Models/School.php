<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class School extends Model
{
    use HasFactory;

    public function school_category(){
        return $this->belongsTo('App\Model\SchoolCategory', 'category_id');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }

    static function fetchFeildsGeric($table,$fetch_field,$where_feild,$id){

        //echo "in control"; exit;

        $category = DB::table($table)->where($where_feild,$id)->first();
        return @$category->$fetch_field;
    }
}
