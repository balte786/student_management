<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function fetchSchools(){

        $school_id = $_REQUEST['id'];

        $all_schols	=	School::where('category_id','=',$school_id)->get();

        $html ='';

        foreach($all_schols as $schools){

            $html.='<option value="'.$schools->id.'">'.$schools->school_name.'</option>';

        }

        return response()->json(array('content'=> $html), 200);


    }
}
