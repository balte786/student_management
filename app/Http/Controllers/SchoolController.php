<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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

    public function schools(){

        $data['schools']  =   School::orderBy('id','DESC')->get();
        return view('schools', $data);
    }

    public function add_school(){


        $data['states']  = DB::table('states')->get();
        $data['school_categories']  = DB::table('school_categories')->get();
        return view('add-school', $data);

    }

    public function save_school(Request $request){

        $this->validate($request, [
            'school_name' => 'required|max:120',
            'school_code' => 'required|max:120']);

        $school =   new School;

        $school->school_name            =   $request->school_name;
        $school->school_code            =   $request->school_code;
        $school->category_id            =   $request->category_id;
        $school->status                 =   $request->status;
        $school->school_location        =    $request->state_id;
        $school->state_id        =    $request->state_id;

        if($school->save()) {
            $request->session()->flash('message', 'School Successfully Added!');
            return redirect('admin-schools');
        }

        //echo $school->school_name;
    }

    public function school_view($id){

        $data['states']  = DB::table('states')->get();
        $data['school_categories']  = DB::table('school_categories')->get();
       $data['edit_school']     =   school::find($id);
        return view('admin-school-view', $data);
    }

    public function edit_school($id){

        $data['states']  = DB::table('states')->get();
        $data['school_categories']  = DB::table('school_categories')->get();
        $data['edit_school']     =   school::find($id);
        return view('edit-school', $data);
    }

    static function fetchFeilds($table,$feild,$id){

        $category = DB::table($table)->find($id);
        return $category->$feild;
    }

    public function update_school(request $request,$id){

        $this->validate($request, [
            'school_name' => 'required|max:120',
            'school_code' => 'required|max:120']);


        $school   =   School::find($id);
        $school->school_name            =   $request->school_name;
        $school->school_code            =   $request->school_code;
        $school->category_id            =   $request->category_id;
        $school->status                 =   $request->status;
        $school->school_location        =    $request->state_id;
        $school->state_id        =    $request->state_id;

        if($school->save()) {
            $request->session()->flash('message', 'School Updated Successfully!');
            return redirect('admin-schools');
        }

        //echo $school->school_name;
    }

    public function delete_school(request $request,$id){

        DB::table('schools')->delete($id);
        $request->session()->flash('message', 'School Has Been Deleted Successfully!');
        return redirect('admin-schools');

    }





}
