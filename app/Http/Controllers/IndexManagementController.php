<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexManagement;
use Auth;
use App\Imports\IndexImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SchoolQuota;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use DB;

class IndexManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {


            $data['title'] = 'School index list';
            $data['page'] = 'School index list';
            $data['index_lists']    = IndexManagement::select('index_managements.id','index_managements.status','index_managements.created_at', 'schools.school_name','school_quotas.year','school_quotas.quota')
                ->join('schools','index_managements.school_id', '=', 'schools.id')
                ->join('school_quotas','index_managements.quota_id', '=', 'school_quotas.id')
                ->where('index_managements.school_id',Auth::user()->school_id)
                ->orderby('index_managements.year','desc')
                ->get();



            return view('school-index-list', $data);


    }

    public function index_upload(){
        $data['page'] = 'Admin Quota Management';
        return view('school-index-upload', $data);
    }
    public function school_index_import(Request $request){
        $this->validate($request, [
            'year' => 'required',
            'file' => 'required|max:10000|mimes:xlsx'

        ]);
        $school_id  =   Auth::user()->school_id;
        $quotas  =   SchoolQuota::where(array('school_id'=>$school_id,'year'=>$request->year))->first();
        if($quotas){
            $quota_id = $quotas->id;
            $quota = $quotas->quota;
            $index_record   =   IndexManagement::where(array('school_id'=>$school_id,'year'=>$request->year))->get();
            if($index_record->count()==0){

                $index_mang = new IndexManagement;
                $index_mang->school_id = $school_id;
                $index_mang->quota_id  = $quota_id;
                $index_mang->year = $request->year;
                $index_mang->status ='0';

                if($index_mang->save()){
                    $index_id   =   $index_mang->id;
                    Excel::import(new IndexImport($request->year,$school_id,$quota_id,$index_id),request()->file('file'));
                    $request->session()->flash('message', 'Successfully uploaded the index');
                    return redirect('school-index-upload-doc/'.$index_id);
                }else{
                    $request->session()->flash('message', 'Something happened wrong try later');
                    return redirect('school-index-upload');
                }
            }else{
                $request->session()->flash('message', 'You have already uploaded quota against this year');
                return redirect('school-index-upload');
            }




        }else{
            $request->session()->flash('message', 'Quota is not assigned against this school for this year');
            return redirect('school-index-upload');
        }


    }

    public function school_index_approved($id){

        $data['pages']     =   "Approved";
        $data['approved_students']      =   Student::where(array('index_id'=>$id))->get();
        return view('school-index-approved', $data);

    }

    public function school_index_upload_doc($id){

        $data['pages']     =   "Student Docs";
        $data['students_list']    =    Student::where(array('index_id'=>$id))->get();

        $std_list =   IndexManagement::where(array('id'=>$id))->first();

        //print_r($std_list);exit;

        $data['quota_data']            =    SchoolQuota::where('id',$std_list->quota_id)->first();
        return view('school-index-upload-doc', $data);
    }

    public function upload_student_docs_ajax(request $request){

        $data = array();
        $index_id      =    $request->index_id;
        $student_id      =    $request->student_id;
        $validator = Validator::make($request->all(), [
            'student_doc' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx|max:2048'
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('student_doc');// Error response

        }else{
            if($request->file('student_doc')) {

                $file = $request->file('student_doc');
                $filename = $index_id.'_'.time().'_'.$file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                $location = 'student_files';

                // Upload file
                if($file->move($location,$filename)){

                    $checkExist    =    DB::table('student_files')->where('student_id',$student_id)->first();

                    if($checkExist){

                        $values = array('student_id' => $student_id,'file_name' => $filename);
                        DB::table('student_files')->where('student_id',$student_id)->update($values);

                        $data['message'] = 'Updated Successfully!';

                    }else{

                        $values = array('student_id' => $student_id,'file_name' => $filename);
                        DB::table('student_files')->insert($values);

                        $data['message'] = 'Uploaded Successfully!';
                    }


                }

                // File path
                $filepath = url('student_files/'.$filename);

                // Response
                $data['success'] = 1;


            }else{
                // Response
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);

    }

    public function school_index_submission(request $request){

        $request->session()->flash('message', 'Successfully uploaded the index');
        return redirect('school-index-list');
    }

    static function countApplicants($id){

        return Student::where('index_id',$id)->count();
    }
}





