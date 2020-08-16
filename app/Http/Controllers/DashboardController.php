<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;

class DashboardController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $data = $this->user::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('last_login_at', function ($data){
                    return date('d-M-Y H:i', strtotime($data->last_login_at) );
                })
                ->make(true);
        }
        return view('Dashboard.index');
    }
}
