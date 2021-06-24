<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

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
}
