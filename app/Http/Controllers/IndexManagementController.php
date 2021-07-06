<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Models\IndexManagement;
use App\Models\School;
use Auth;
use App\Mail\MailIndexNumberUploaded;
use App\Imports\CountIndexMangamentImport;
use App\Imports\IndexImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SchoolQuota;
use App\Models\Student;
use App\Models\HoldStudents;
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

            $array = (new CountIndexMangamentImport)->toArray(request()->file('file'));
            $count_row	=	count($array[0])-1;
            if($count_row>$quota){
                $request->session()->flash('message', 'Your inserted record has been greater than your quota. Please upload max '.$quota.' numbers of records');
                return redirect('school-index-upload');
            }else{
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
                    $request->session()->flash('message', 'Application for Index Numbers has already been submitted for this year');
                    return redirect('school-index-upload');
                }
            }


        }else{
            $request->session()->flash('message', 'Quota is not assigned against this school for this year');
            return redirect('school-index-upload');
        }


    }

    public function school_index_approved($id){

        $data['pages']     =   "Approved";
        $data['index_id']   =   $id;
        $data['index_year']      =   IndexManagement::where(array('id'=>$id))->first()->year;
        $data['approved_students']      =   Student::where(array('index_id'=>$id))->get();
        return view('school-index-approved', $data);

    }

    public function school_index_upload_doc($id){

        $data['pages']     =   "Student Docs";
        $data['students_list']    =    HoldStudents::where(array('index_id'=>$id))->get();
        $data['index_id']     =   $id;
        $std_list =   IndexManagement::where(array('id'=>$id))->first();

        //print_r($std_list);exit;

        $data['quota_data']            =    @SchoolQuota::where('id',$std_list->quota_id)->first();
        return view('school-index-upload-doc', $data);
    }

    public function upload_student_docs_ajax(request $request){

        $data = array();
        $index_id      =    $request->index_id;
        $student_id      =    $request->student_id;
        $school_id      =    $request->school_id;
        $validator = Validator::make($request->all(), [
            'student_doc' => 'required|mimes:pdf|max:2048'
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('student_doc');// Error response

        }else{
            if($request->file('student_doc')) {

                $studentName     = HoldStudents::where('id',$student_id)->first()->first_name;

                $file = $request->file('student_doc');
                $filename = $studentName.'_'.$index_id.'_'.$file->getClientOriginalName();

                $displayName = $filename;

                // File extension
                $extension = $file->getClientOriginalExtension();

                $schoolCode    = School::fetchFeildsGeric('schools','school_code','id',$school_id);
                $year    = School::fetchFeildsGeric('index_managements','year','id',$index_id);

                $location = 'student_upload_files/'.$schoolCode.'/'.$year.'/'.$student_id;

               //echo "lockkkkk>>".$location; exit;

                // Upload file
                if($file->move($location,$filename)){

                    $checkExist    =    DB::table('hold_student_files')->where('student_id',$student_id)->first();

                    if($checkExist){

                        $values = array('student_id' => $student_id,'file_name' => $filename);
                        DB::table('hold_student_files')->where('student_id',$student_id)->update($values);

                        $data['message'] = 'Updated Successfully!';

                    }else{

                        $values = array('student_id' => $student_id,'file_name' => $filename);
                        DB::table('hold_student_files')->insert($values);

                        $data['message'] = 'Uploaded Successfully!';
                    }


                }

                // File path
                $filepath = url('student_upload_files/'.$filename);

                // Response
                $data['success'] = 1;

               // $data['filename'] = $displayName;


            }else{
                // Response
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);

    }



    public function school_index_submission(request $request,$index_id){



        $this->validate($request, [
            "student_doc.*"  => "required|mimes:pdf|max:2048",
            "student_pic.*"  => "required|mimes:jpeg,jpg,png,gif|max:1048"


        ]);


        //echo "passed"; exit;





        $data = array();
        $index_id      =    $request->index_id;

        $school_id      =    $request->school_id;


        $student_id =   $request->student_id;

        foreach($student_id as $id){

            $student_file = $request->file('student_doc')[$id];
            $student_picture = $request->file('student_pic')[$id];

            $studentName     = HoldStudents::where('id',$id)->first()->first_name;

            $filename = $studentName.'_'.$index_id.'_'.$student_file->getClientOriginalName();
            $imagename = $studentName.'_'.$index_id.'_'.$student_picture->getClientOriginalName();

            //$fileextension = $student_file->getClientOriginalExtension();
            //$pictureextension = $student_picture->getClientOriginalExtension();

            $schoolCode    = School::fetchFeildsGeric('schools','school_code','id',$school_id);
            $year    = School::fetchFeildsGeric('index_managements','year','id',$index_id);

            $location = 'student_upload_files/'.$schoolCode.'/'.$year.'/'.$id;

            if($student_file->move($location,$filename)){

                $checkExist    =    DB::table('hold_student_files')->where('student_id',$id)->first();

                if($checkExist){

                    $values = array('student_id' => $id,'file_name' => $filename);
                    DB::table('hold_student_files')->where('student_id',$id)->update($values);

                    //$data['message'] = 'Updated Successfully!';

                }else{

                    $values = array('student_id' => $id,'file_name' => $filename);
                    DB::table('hold_student_files')->insert($values);

                    //$data['message'] = 'Uploaded Successfully!';
                }

            }


            if($student_picture->move($location,$imagename)){

                $checkExist    =    DB::table('hold_student_pictures')->where('student_id',$id)->first();

                if($checkExist){

                    $values = array('student_id' => $id,'file_name' => $imagename);
                    DB::table('hold_student_pictures')->where('student_id',$id)->update($values);

                    //$data['message'] = 'Updated Successfully!';

                }else{

                    $values = array('student_id' => $id,'file_name' => $imagename);
                    DB::table('hold_student_pictures')->insert($values);

                    //$data['message'] = 'Uploaded Successfully!';
                }

            }



        }

        $indexUpdate       = IndexManagement::find($index_id);


        $indexUpdate->uploading_status      =    '1';

        if($indexUpdate->save()){

            $first_name     =   Auth::user()->first_name;
            $email     =   Auth::user()->email;
            $user_school_name      =    School::where('id',Auth::user()->school_id)->first()->school_name;
            $site_url   =   url('/');
            $email_data = array(
                'first_name'=>$first_name,
                'school_name'=>$user_school_name,
                'site_url'=>$site_url
            );
            try{
                Mail::to($email)->send(new MailIndexNumberUploaded($email_data));
            }
            catch(\Exception $e){

            }
        }


        $request->session()->flash('message', 'Successfully uploaded the index');
        return redirect('school-index-list');



        exit;





            if($request->file('student_doc')) {









                //print_r($file); exit;







                //echo "lockkkkk>>".$location; exit;

                // Upload file
                if($file->move($location,$filename)){

                    $checkExist    =    DB::table('hold_student_files')->where('student_id',$student_id)->first();

                    if($checkExist){

                        $values = array('student_id' => $student_id,'file_name' => $filename);
                        DB::table('hold_student_files')->where('student_id',$student_id)->update($values);

                        //$data['message'] = 'Updated Successfully!';

                    }else{

                        $values = array('student_id' => $student_id,'file_name' => $filename);
                        DB::table('hold_student_files')->insert($values);

                        //$data['message'] = 'Uploaded Successfully!';
                    }

                }




                // File path
               // $filepath = url('student_upload_files/'.$filename);

                // Response
               // $data['success'] = 1;

                // $data['filename'] = $displayName;


            }

    }

    static function countApplicants($id){

        return Student::where('index_id',$id)->count();
    }

    static function countHoldApplicants($id){

        return HoldStudents::where('index_id',$id)->count();
    }


    public function upload_picture_ajax(request $request){

        $data = array();
        $index_id      =    $request->index_id;
        $student_id      =    $request->student_id;
        $school_id      =    $request->school_id;
        $validator = Validator::make($request->all(), [
            'student_pic' => 'required|mimes:png,jpg,jpeg|max:1048'
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('student_pic');// Error response

        }else{
            if($request->file('student_pic')) {

                $studentName     = HoldStudents::where('id',$student_id)->first()->first_name;

                $file = $request->file('student_pic');
                $filename = $studentName.'_'.$index_id.'_'.$file->getClientOriginalName();

                $displayName = $filename;

                // File extension
                $extension = $file->getClientOriginalExtension();

                $schoolCode    = School::fetchFeildsGeric('schools','school_code','id',$school_id);
                $year    = School::fetchFeildsGeric('index_managements','year','id',$index_id);

                $location = 'student_upload_files/'.$schoolCode.'/'.$year.'/'.$student_id;

                //  echo "lockkkkk".$location; exit;

                // Upload file
                if($file->move($location,$filename)){

                    $checkExist    =    DB::table('hold_student_pictures')->where('student_id',$student_id)->first();

                    if($checkExist){

                        $values = array('student_id' => $student_id,'file_name' => $filename);
                        DB::table('hold_student_pictures')->where('student_id',$student_id)->update($values);

                        $data['message'] = 'Updated Successfully!';

                    }else{

                        $values = array('student_id' => $student_id,'file_name' => $filename);
                        DB::table('hold_student_pictures')->insert($values);

                        $data['message'] = 'Picture Uploaded Successfully!';
                    }


                }

                // File path
                $filepath = url('student_upload_files/'.$filename);

                // Response
                $data['success'] = 1;

                // $data['filename'] = $displayName;


            }else{
                // Response
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);

    }

}





