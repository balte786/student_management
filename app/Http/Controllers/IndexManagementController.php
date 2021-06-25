<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexManagement;
use Auth;
use App\Imports\IndexImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SchoolQuota;

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
            $data['index_lists']    = IndexManagement::select('index_managements.status','index_managements.created_at', 'schools.school_name','school_quotas.year','school_quotas.quota')
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
                    return redirect('school-index-list');
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
}
