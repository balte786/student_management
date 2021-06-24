<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Models\User;
use App\Models\SchoolCategory;
use App\Mail\MailAdminPassword;
use App\Models\SchoolQuota;
use App\Imports\QuotaImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

            $data = [];
            $data['page'] = 'dashboard';
            return view('dashboard', $data);
    }

    public function admin_users(){

        $data['users']  =   User::where('admin',1)->get();
        return view('admin-users', $data);

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
        $user->school_id         =   1;
        $user->admin         =   1;
        $random_password         =   substr(md5(microtime()),rand(0,26),8);
        $user->password          =   $random_password;
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
        return view('editAdminUser', $data);

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

    public function quota_upload()
    {
        $data['page'] = 'Admin Quota Management';
        return view('admin-quota-upload', $data);
    }

    public function import(Request $request)
    {
        Excel::import(new QuotaImport($request->year,$request->category_id),request()->file('file'));
        $request->session()->flash('message', 'Successfully uploaded the quota');
        return redirect('admin/quota');
    }
}
