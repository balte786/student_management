<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsAprrovedExport;
use App\Models\IndexManagement;
use Illuminate\Http\Request;
use DB;
use App\Models\School;

class SchoolController extends Controller
{
    public function fetchSchools(){

        $school_id = $_REQUEST['id'];

        $all_schols	=	School::where('category_id','=',$school_id)->where('id','!=','1')->get();

        $html ='';

        foreach($all_schols as $schools){

            $html.='<option value="'.$schools->id.'">'.$schools->school_name.'</option>';

        }

        return response()->json(array('content'=> $html), 200);


    }

    public function schools(){

        $data['schools']  =   School::where('id','!=','1')->orderBy('id','DESC')->get();
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
        return @$category->$feild;
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

    static function fetchTotalCounts($cat_id,$feild_name){

        return School::where($feild_name,$cat_id)->count();

    }

    static function fetchTotalCountsUniversity(){

        return School::where('category_id','1')
            ->where('school_code','!=','ADMINSCHOOL')->count();

    }

    static function fetchFeildsFiles($id){

    //echo "in control"; exit;

    $category = DB::table('hold_student_files')->where('student_id',$id)->first();
    return @$category->file_name;
}

    static function fetchFeildsFilesApproved($id){

        //echo "in control"; exit;

        $category = DB::table('student_files')->where('student_id',$id)->first();
        return @$category->file_name;
    }

    static function fetchFeildsPic($id){

        //echo "in control"; exit;

        $category = DB::table('hold_student_pictures')->where('student_id',$id)->first();
        return @$category->file_name;
    }


    static function fetchFeildsFiles2($id){

        //echo "in control"; exit;

        $category = DB::table('student_files')->where('student_id',$id)->first();
        return @$category->file_name;
    }

    static function fetchFeildsPic2($id){

        //echo "in control"; exit;

        $category = DB::table('student_pictures')->where('student_id',$id)->first();
        return @$category->file_name;
    }



    static function fetchFeildsGeric($table,$fetch_field,$where_feild,$id){

        //echo "in control"; exit;

        $category = DB::table($table)->where($where_feild,$id)->first();
        return @$category->$fetch_field;
    }

    public function approved_export_index($index_id){

        $index_rec  =   IndexManagement::where('id',$index_id)->first();
        $schools    =   School::where('id',$index_rec->school_id)->first();
        $file_name  =   $schools->school_code.'_'.$index_rec->year;

        return Excel::download(new StudentsAprrovedExport($index_id), $file_name.'.xlsx');

    }

}
