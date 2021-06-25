<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

use DB;

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

    public function admin_schools_profiles(){

        $data['schools_profiles']  =   User::where('admin','0')->orderBy('id','DESC')->get();
        return view('admin-schools-profiles', $data);
    }

    public function admin_schools_profiles_view($id){

    $data['states']  = DB::table('states')->get();
    $data['school_categories']  = DB::table('school_categories')->get();
    $data['user_details']     =   User::find($id);
    return view('admin-schools-profiles-view', $data);
    }

    public function approve_user_profile(request $request, $id){

        $user   =   User::find($id);

        $user->status   =   1;
        $user->approved_at   =   now();

        if($user->save()) {
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
}
