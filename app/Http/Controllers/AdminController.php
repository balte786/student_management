<?php

namespace App\Http\Controllers;

use App\Exports\StudentsAprrovedExport;
use App\Exports\StudentsExport;
use App\Exports\SchoolQuotaExport;

use App\Models\School;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Models\User;
use App\Models\SchoolCategory;
use App\Models\Student;
use App\Models\HoldStudents;
use App\Models\IndexManagement;
use App\Mail\MailAdminPassword;
use App\Mail\MailIndexApproved;
use App\Mail\MailUserAprrovedAdmin;
use App\Models\SchoolQuota;
use App\Imports\QuotaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Storage;
use File;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

            if(Auth::user()->admin){
                $data = [];
                $data['page'] = 'dashboard';
                return view('dashboard', $data);
            }else{
                $data = [];

                $data['yearly_quota']   =   SchoolQuota::where('school_id',Auth::user()->school_id)
                    ->orderby('year','ASC')
                    ->pluck('quota')->toArray();
                $data['years']   =   SchoolQuota::where('school_id',Auth::user()->school_id)
                    ->orderby('year','ASC')
                    ->pluck('year')->toArray();
                $data['quotas']   =   SchoolQuota::where('school_id',Auth::user()->school_id)
                    ->orderby('year','ASC')->get();

                $data['page'] = 'dashboard';
                return view('front-dashboard', $data);
            }

    }

    public function admin_users(){

        $data['users']  =   User::where('admin',1)->get();
        return view('admin-users', $data);

    }

    public function admin_schools_profiles(){

        $data['schools_profiles']  =   User::where('admin' ,'0')->orderBy('id','DESC')->get();

        return view('admin-schools-profiles', $data);
    }

    public function admin_schools_profiles_view($id){

    $data['states']  = DB::table('states')->get();
    $data['school_categories']  = DB::table('school_categories')->get();
    $data['user_details']     =   User::join('schools','schools.id', '=', 'users.school_id')
        ->where('users.id',$id)
        ->first();
    return view('admin-schools-profiles-view', $data);
    }

    public function approve_user_profile(request $request, $id){

        $user   =   User::find($id);

        $user->status   =   '1';
        $user_school_name      =    School::where('id',$user->school_id)->first()->school_name;
        $user->approved_at   =   now();

        if($user->save()) {
			
			$site_url   =   url('/');
            $email_data = array(
                'first_name'=>$user->first_name,
                'school_name'=>$user_school_name,
                'site_url'=>$site_url
            );
            try{ 
			Mail::to($user->email)->send(new MailUserAprrovedAdmin($email_data));
			}
            catch(\Exception $e){
			
				}
			
            $request->session()->flash('message', 'User Has Been Activated Successfully!');
            return redirect('admin-schools-profiles');
        }
    }

    public function reject_user_profile(request $request, $id){

        $user   =   User::find($id);

        $user->status   =   2;

        if($user->save()) {
            $request->session()->flash('message', 'User Has Been Rejected Successfully!');
            return redirect('admin-schools-profiles');
        }
    }
    public function user_create(){

        $data['school_types']  =  SchoolCategory::all();
        return view('addAdminUser', $data);

    }
    public function user_store(Request $request){
        $user = new User;
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=> ['required', 'string', 'max:255'],
            'category_id' =>'required',
            'status' =>'required',

        ]);
        $user->first_name        =   $request->first_name;
        $user->last_name         =   $request->last_name;
        $user->name              =   $request->first_name.' '.$request->last_name;
        $user->email             =   $request->email;
        $user->phone_number      =   $request->phone;
        $user->category_id       =   $request->category_id;
        $user->email_verified_at = now();
        if($request->status==1){
            $user->approved_at = now();
        }
        $user->status= $request->status;
        $user->school_id         =   1;
        $user->admin         =   1;
        $random_password         =   substr(md5(microtime()),rand(0,26),8);
        $user->password          =   Hash::make($random_password);
        if($user->save()) {

            $site_url   =   url('/');
            $email_data = array(
                'first_name'=>$request->first_name,
                'email'=>$request->email,
                'site_url'=>$site_url,
                'password'=>$random_password
            );
            try{ Mail::to($request->email)->send(new MailAdminPassword($email_data));}
            catch(\Exception $e){}

        }
        $request->session()->flash('message', 'Successfully created admin user!');
        return redirect('admin-users');
    }

    public function user_edit($user_id){

        $data['page'] = 'Edit Admin User';
        $data['user_id'] = $user_id;
        $data['school_types']  =  SchoolCategory::all();
        $data['user']  = User::where('id',$user_id)->first();
        return view('admin-user-view', $data);

    }

    public function user_update(Request $request){

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.$request->user_id,
            'phone'=> ['required', 'string', 'max:255'],
            'category_id' =>'required',
            'status' =>'required',

        ]);

        $user   =   User::find($request->user_id);
        $user->first_name        =   $request->first_name;
        $user->last_name         =   $request->last_name;
        $user->name              =   $request->first_name.' '.$request->last_name;
        $user->phone_number     =   $request->phone;
        $user->email             =   $request->email;
        $user->category_id       =   $request->category_id;
        $user->status           =  $request->status;
        if($request->status==1){
            $user->approved_at = now();
        }else{
            $user->approved_at = NULL;
        }
        if($user->save()) {
            $request->session()->flash('message', 'Successfully updated admin contact info!');
        }else
            $request->session()->flash('message', 'Something wrong please try again!');
        return redirect('admin-users');

    }

    public function profile(){

        $data['page'] = 'Profile';
        $data['school_types']  =  SchoolCategory::all();
        $data['user']  = User::where('id',Auth::user()->id)->first();
        return view('admin-profile', $data);

    }

    public function profile_update(Request $request){

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'phone'=> ['required', 'string', 'max:255'],
            'password' => ['nullable','string', 'min:8', 'confirmed'],
            'category_id' =>'required',
            'status' =>'required',

        ]);

        $user   =   User::find(Auth::user()->id);
        $user->first_name        =   $request->first_name;
        $user->last_name         =   $request->last_name;
        $user->name              =   $request->first_name.' '.$request->last_name;
        $user->phone_number     =   $request->phone;
        $user->email             =   $request->email;
        $user->category_id       =   $request->category_id;

        if($request->password) {
            $user->password = Hash::make($request->password);

        }
        if($request->status==1){
            $user->approved_at = now();
        }else{
            $user->approved_at = NULL;
        }
        if($user->save()) {
            $request->session()->flash('message', 'Successfully updated your profile!');
        }else
            $request->session()->flash('message', 'Something wrong please try again!');
        return redirect('admin/profile');

    }

    public function admin_quota(){

        $data['page'] = 'Admin Quota Management';
        $data['quotas'] = SchoolQuota::
        join('school_categories','school_categories.id', '=', 'school_quotas.category_id')
            ->groupby('school_quotas.year','school_quotas.category_id')
            ->orderby('year','desc')
            ->get();
        return view('admin-quota', $data);
    }

    public function admin_quota_year($year){

        $data['year'] = $year;
        $data['quotas'] = SchoolQuota::
        join('schools','school_quotas.school_id', '=', 'schools.id')
            ->join('school_categories','school_quotas.category_id', '=', 'school_categories.id')
            ->where('school_quotas.year',$year)
            ->get();

        $data['page'] = 'Admin Quota Year';
        return view('admin-quota-year', $data);
    }

    public function quota_upload()
    {
        $data['page'] = 'Admin Quota Management';
        return view('admin-quota-upload', $data);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'year' => 'required',
            'category_id'=> 'required',
            'file' => 'required|max:10000|mimes:xlsx'

        ]);
        Excel::import(new QuotaImport($request->year,$request->category_id),request()->file('file'));
        $request->session()->flash('message', 'Successfully uploaded the quota');
        return redirect('admin/quota');
    }

    public function admin_dashboard(){

        $data['page'] = 'Admin Dashboard';
        return view('admin_dashboard', $data);
    }

    static function fetchTotalCounts($cat_id,$feild_name){

        return User::where($feild_name,$cat_id)->count();

    }

    public function school_dashboard(){

        $data['page'] = 'School Dashboard';
        $data['myquotas'] = SchoolQuota::where('school_id',Auth::user()->school_id)->get();


        return view('school-dashboard', $data);
    }

    public function school_profile(){

        $data['page'] = 'School Profile';
        $data['school_types']  =  SchoolCategory::all();
        $data['user']  = User::where('id',Auth::user()->id)->first();
        return view('profile', $data);
    }

    public function school_profile_update(Request $request){

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'phone'=> ['required', 'string', 'max:255'],


        ]);

        $user   =   User::find(Auth::user()->id);
        $user->first_name        =   $request->first_name;
        $user->last_name         =   $request->last_name;
        $user->name              =   $request->first_name.' '.$request->last_name;
        $user->phone_number     =   $request->phone;
        $user->email             =   $request->email;


        if($user->save()) {
            $request->session()->flash('message', 'Successfully updated your profile!');
        }else
            $request->session()->flash('message', 'Something wrong please try again!');
        return redirect('profile');

    }

    public function admin_index_list(){

        $data['title'] = 'Admin index list';
        $data['page'] = 'Admin index list';
        $data['index_lists']    = IndexManagement::select('index_managements.id','index_managements.status','index_managements.created_at', 'schools.school_name','school_quotas.year','school_quotas.quota')
            ->join('schools','index_managements.school_id', '=', 'schools.id')
            ->join('school_quotas','index_managements.quota_id', '=', 'school_quotas.id')
            ->where('index_managements.uploading_status','1')
             ->orderby('index_managements.year','desc')
            ->get();


        return view('admin-index-list', $data);
    }

    public function admin_index_pending($index_id){

        $data['title'] = 'Admin index list';
        $data['page'] = 'Admin index list';
        $data['index_id']   =   $index_id;
        $data['student_lists']    = HoldStudents::where('index_id',$index_id)->get();


        return view('admin-index-pending', $data);

    }
	
	public function approve_students(request $request){
		
		
		 $this->validate($request, [
            'student_ids' => 'required'

        ]);
	
	$index_id	=	$request->index_id;
	$student_ids	=	array();
    $indexData       =    IndexManagement::where('id',$index_id)->first();
    $year       =   $indexData->year;
    $schoolCode     =   School::where('id',$indexData->school_id)->first()->school_code;
    $category_id     =   School::where('id',$indexData->school_id)->first()->category_id;
	$student_ids	=	$request->student_ids;
	$counter    =   IndexManagementController::countApplicants($index_id)+1;
	for($i=0;$i<count($student_ids); $i++){
		
		//$values = array('status' => '1');
         //DB::table('students')->where('id',$student_ids[$i])->update($values);


        $hold_students   =    DB::table('hold_students')->where('id',$student_ids[$i])->first();

        if($category_id=='2') {

            $index_number = 'PCN/' . $schoolCode . '/' . substr($year, -2) . '/' . sprintf("%04d", $counter);

        }else if($category_id=='1'){

            $index_number = $schoolCode . substr($year, -2) .sprintf("%04d", $counter);
        }

        $student = new Student;
        $student->school_id         =   $hold_students->school_id;
        $student->quota_id        =   $hold_students->quota_id;
        $student->index_id        =   $hold_students->index_id;
        $student->status        =   1;
        $student->index_number        =   $index_number;
        $student->first_name        =   $hold_students->first_name;
        $student->middle_name        =   $hold_students->middle_name;
        $student->last_name        =   $hold_students->last_name;
        $student->email        =   $hold_students->email;
        $student->phone        =   $hold_students->phone;
        $student->religion        =   $hold_students->religion;
        $student->marital_status        =   $hold_students->marital_status;
        $student->gender        =   $hold_students->gender;
        $student->date_of_birth        =   $hold_students->date_of_birth;
        $student->place_of_birth        =   $hold_students->place_of_birth;
        $student->state_of_origin        =   $hold_students->state_of_origin;
        $student->lga        =   $hold_students->lga;
        $student->home_address        =   $hold_students->home_address;
        $student->name_of_nok        =   $hold_students->name_of_nok;
        $student->address_of_nok        =   $hold_students->address_of_nok;
        $student->name_of_parent        =   $hold_students->name_of_parent;
        $student->address_of_parent        =   $hold_students->address_of_parent;
        $student->date_admitted        =  $hold_students->date_admitted;
        $student->admission_number        =   $hold_students->admission_number;
        $student->qualification_one        =   $hold_students->qualification_one;
        $student->qualification_one_date        =   $hold_students->qualification_one_date;
        $student->qualification_two        =   $hold_students->qualification_two;
        $student->qualification_two_date        =   $hold_students->qualification_two_date;
        $student->qualification_three        =   $hold_students->qualification_three;
        $student->qualification_three_date        =   $hold_students->qualification_three_date;
        $student->qualification_four        =   $hold_students->qualification_four;
        $student->qualification_four_date        =   $hold_students->qualification_four_date;
        $student->qualification_five        =   $hold_students->qualification_five;
        $student->qualification_five_date        =   $hold_students->qualification_five_date;

        if($student->save()) {

            $newStudentId = $student->id;

            $hold_students_files = DB::table('hold_student_files')->where('student_id', $hold_students->id)->first();

            if ($hold_students_files) {

                $values = array('student_id' => $newStudentId, 'file_name' => $hold_students_files->file_name);
                DB::table('student_files')->insert($values);

            if(file_exists(public_path('student_upload_files/'.$schoolCode.'/'.$year.'/'.$hold_students->id.'/'.$hold_students_files->file_name))){

                if (! File::exists(public_path('student_approved_files/'.$schoolCode.'/'.$year.'/'.$newStudentId.''))) {
                    File::makeDirectory(public_path('student_approved_files/'.$schoolCode.'/'.$year.'/'.$newStudentId.''), 755, true, true);
                }


                File::move(public_path('student_upload_files/'.$schoolCode.'/'.$year.'/'.$hold_students->id.'/'.$hold_students_files->file_name), public_path('student_approved_files/'.$schoolCode.'/'.$year.'/'.$newStudentId.'/'.$hold_students_files->file_name));
            }

            }


            //--------------inserting pictures-------------------


            $hold_students_pictures   =    DB::table('hold_student_pictures')->where('student_id',$hold_students->id)->first();
            if($hold_students_pictures){
                $values = array('student_id' => $newStudentId, 'file_name'=> $hold_students_pictures->file_name);
                DB::table('student_pictures')->insert($values);

                if(file_exists(public_path('student_upload_files/'.$schoolCode.'/'.$year.'/'.$hold_students->id.'/'.$hold_students_pictures->file_name))){

                    if (! File::exists(public_path('student_approved_files/'.$schoolCode.'/'.$year.'/'.$newStudentId.''))) {
                        File::makeDirectory(public_path('student_approved_files/'.$schoolCode.'/'.$year.'/'.$newStudentId.''), 755, true, true);
                    }

                    File::move(public_path('student_upload_files/'.$schoolCode.'/'.$year.'/'.$hold_students->id.'/'.$hold_students_pictures->file_name), public_path('student_approved_files/'.$schoolCode.'/'.$year.'/'.$newStudentId.'/'.$hold_students_pictures->file_name));
                }
            }

            DB::table('hold_students')->delete($hold_students->id);
            File::deleteDirectory(public_path('student_upload_files/'.$schoolCode.'/'.$year.'/'.$hold_students->id));

        }



        $counter++;

	}

	$values2 = array('status' => '1');
	$index	=	 IndexManagement::find($index_id);
	$index->status = '1';
	if($index->save()){

	    if($counter=='1') {

            $user_record = User::where('school_id', $request->school_id)->first();
            $user_school_name = School::where('id', $request->school_id)->first()->school_name;
            $site_url = url('/');
            $email_data = array(
                'first_name' => $user_record->first_name,
                'year' => $index->year,
                'school_name' => $user_school_name,
                'site_url' => $site_url
            );
            try {
                Mail::to($user_record->email)->send(new MailIndexApproved($email_data));
            } catch (\Exception $e) {
            }
        }


	}
	//DB::table('index_managements')->where('id',$index_id)->update($values2);
	
	$request->session()->flash('message', 'Student has been approved Successfully!');
	 return redirect('admin-index-pending/'.$index_id);
		
	}

    static function fetchTotalStudentCounts($cat_id,$feild_name){

        return Student::where($feild_name,$cat_id)->count();

    }

    public function export_index($index_id){

        $index_rec  =   IndexManagement::where('id',$index_id)->first();
        $schools    =   School::where('id',$index_rec->school_id)->first();
        $file_name  =   $schools->school_code.'_'.$index_rec->year;

        return Excel::download(new StudentsExport($index_id), $file_name.'.xlsx');

    }

    public function admin_index_approved($id){

        $data['pages']     =   "Approved";
        $index_rec     =   IndexManagement::where(array('id'=>$id))->first();
        $data['index_year']= $index_rec->year;
        $data['index_id']=$id;
        $data['school_name']= School::where('id',$index_rec->school_id)->first()->school_name;
        $data['approved_students']      =   Student::where(array('index_id'=>$id))->get();
        return view('admin-index-approved', $data);

    }

    public function admin_approved_export_index($index_id){

        $index_rec  =   IndexManagement::where('id',$index_id)->first();
        $schools    =   School::where('id',$index_rec->school_id)->first();
        $file_name  =   $schools->school_code.'_'.$index_rec->year;

        return Excel::download(new StudentsAprrovedExport($index_id), $file_name.'.xlsx');

    }

    public function quota_template_export($category_id){

       // echo "iam".$category_id;

        //exit;

        $file_name  = "Quota";
        return Excel::download(new SchoolQuotaExport($category_id), $file_name.'.xlsx');
    }
}
