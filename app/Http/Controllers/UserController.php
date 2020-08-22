<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Auth;
use DataTables;

class UserController extends Controller
{
    public function userupdate()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('User.updateuser',compact('user'));
    }

    public function updateuser(Request $request, $id)
    {
           $v = Validator::make($request->all(),[
               'name' => 'required',
               'email' => 'required|unique:users,email,'.$id,
           ],[
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.unique' => 'Email has change !',
           ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            User::find($id)->update($request->only('name','email'));
            return back()->with('sucess','Data Success Update !');
        }
    }

    public function passupdate()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('User.updatepass',compact('user'));
    }

    public function updatepass(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (Hash::check($request->old_password, $user->password)) {
            $v = Validator::make($request->all(),[
                'old_password' => 'required',
                'new_password' => 'required|confirmed|min:6',
                'new_password_confirmation' => 'required'
            ],[
                'old_password.required' => 'Password Lama Harus diisi !',
                'new_password.required' => 'Password Baru Harus diisi !',
                'new_password_confirmation.required'=> 'Password Baru Harus dikonfirmasi !',
                'new_password.min' => 'Password Minimal 6 Karakter',
                'new_password_confirmation.confirmed' => 'Konfirmasi Password Baru tidak sesuai'
            ]);

            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            }
            $user = User::find($id)->update(['password' => Hash::make($request->new_password)]);

            if ($user) {
                return back()->with('success','Data has Update !');
            } else{
                return back()->with('fail','Data No Update !');
            }
        } else {
            $v = Validator::make($request->all(),[
                'old_password' => 'required',
            ],[
                'old_password.required' => 'Password Lama Harus diisi !',
            ]);
            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            }

            return back()->with('fail','Password Lama anda Tidak Sesuai!');
        }
    }

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
                ->addColumn('action', function($data){
                    return '<a href="/buku-tamu/user/'.$data->id.'/edit" class="btn btn-success btn-sm">Update</a>
                            <a class="btn btn-danger btn-sm" onclick="sweet('.$data->id.')" data-id="'.$data->id.'">Delete</a>';
                })
                ->make(true);
        }
        // dd($count);
        return view('User.index');
    }

    public function create()
    {
        return view('User.create');
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(),[
            'name' => 'required|',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            User::create(array_merge($request->only('name','email','password'),['level'=>2]));
        }
        return back()->with('success','Data Created !');
    }

    public function edit($id)
    {
        $data = User::find($id);

        return view('User.update',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6'
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            User::find($id)->update(array_merge($request->only('name','email','password'),['level'=>2]));
        }

        return back()->with('success','Data Updated !');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return back();
    }
}
